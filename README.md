# AttendanceMS

## Description
AttendanceMS is a web-based application designed to manage attendance for educational institutions. It allows teachers to take attendance, view student details, and generate reports.
## Features
- **Teacher Login**: Teachers can log in to the system to manage attendance.
- **Take Attendance**: Teachers can mark attendance for students in their classes.
- **View Student Details**: Teachers can view details of students in their classes.
- **Generate Reports**: Teachers can generate attendance reports for students.
## Technologies Used
- **Frontend**: HTML, CSS, JavaScript, Bootstrap 4 AdminLTE
- **Backend**: Laravel 12
- **Database**: MySQL
## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/AttendanceMS.git
   ```
2. Navigate to the project directory:
   ```bash
   cd AttendanceMS
   ```
3. Install dependencies:
   ```bash
   composer install
   ```
4. Set up the environment file:
   ```bash
   cp .env.example .env
   ```
5. Generate the application key:
   ```bash
   php artisan key:generate
   ```
6. Run migrations:
   ```bash
   php artisan migrate
   ```
7. Start the development server:
   ```bash
   php artisan serve
   ```
8. Access the application in your web browser at `http://localhost:8000`.
## Usage
- **Login**: Use the credentials provided in the `.env` file or create a new user through the registration page.
- **Take Attendance**: Navigate to the attendance section and select the class to mark attendance.
- **View Student Details**: Go to the student management section to view details of students.
- **Generate Reports**: Use the reports section to generate attendance reports for selected students or classes.
## Contributing
Contributions are welcome! Please follow these steps to contribute:
1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Make your changes and commit them.
4. Push your changes to your forked repository.
5. Create a pull request describing your changes.
