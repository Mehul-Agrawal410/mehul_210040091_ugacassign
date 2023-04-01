from django.db import models

class Student(models.Model):
    name = models.CharField(max_length=50)
    rollNo = models.CharField(max_length=10)
    department = models.CharField(max_length=20)
    hostel = models.PositiveIntegerField()

    def __str__(self):
        return self.name
