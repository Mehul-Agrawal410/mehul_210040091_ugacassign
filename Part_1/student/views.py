from django.shortcuts import render, redirect
from .models import Student
from django.http import HttpResponse
from .models import Student
from .forms import StudentForm
import json

# Create your views here.
def index(request):
    return render(request, 'index.html', {
        'students': Student.objects.all()
    })

def add(request):
    if request.method == 'POST':
        form = StudentForm(request.POST)
        if form.is_valid():
            newStudentName = form.cleaned_data['name']
            newStudentRollNo = form.cleaned_data['rollNo']
            newStudentDepartment = form.cleaned_data['department']
            newStudentHostel = form.cleaned_data['hostel']

            newStudent = Student(
                name = newStudentName,
                rollNo = newStudentRollNo,
                department = newStudentDepartment,
                hostel = newStudentHostel
            )

            newStudent.save()
            return render(request, 'add.html', {
                'form': form,
                'success': True
            })
    else:
        form = StudentForm()
        return render(request, 'add.html', {
            'form': form
        })

def edit(request, id):
    student = Student.objects.get(id=id)
    if request.method == 'POST':
        form = StudentForm(request.POST, instance=student)
        if form.is_valid():
            form.save()
            return redirect('index')
    else:
        form = StudentForm(instance=student)
    return render(request, 'edit.html', {'form': form, 'student': student})

def delete(request, id):
    student = Student.objects.get(id=id)
    student.delete()
    return redirect('index')