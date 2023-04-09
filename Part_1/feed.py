import json
import os
import django

# Set up the Django environment
os.environ.setdefault("DJANGO_SETTINGS_MODULE", "student_info.settings")
django.setup()

# Import the model to insert data
from student.models import Student

# Open the JSON file and load the data
with open('student/fixtures/students.json', 'r') as f:
    student = json.load(f)

# Loop through the data and insert each row into the database
for row in student:
    Student.objects.create(
        name=row['name'], 
        rollNo=row['rollNo'], 
        department=row['department'], 
        hostel=row['hostel']
    )
