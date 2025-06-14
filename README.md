# 🏢 University Leave Management System

A sophisticated, role-based leave management system designed for educational institutions, featuring AI-powered leave reason enhancement and comprehensive workflow automation.

## 📋 Overview

The University Leave Management System is a full-stack web application that streamlines the leave application and approval process for educational institutions. It implements a multi-level approval workflow, role-based access control, and leverages AI to enhance leave application quality.

## ✨ Key Features

- **Role-Based Access Control**

  - Employee self-service portal
  - Department Head (HOD) dashboard
  - Dean's approval interface
  - Principal's oversight panel
  - Administrative control panel

- **Leave Management**

  - Multiple leave types (Study, Maternity, Duty, Long-term)
  - Leave balance tracking
  - Leave history and status monitoring
  - Document attachment support
  - Leave cancellation functionality

- **AI-Enhanced Applications**

  - OpenAI-powered leave reason enhancement
  - Professional language suggestions
  - Grammar and clarity improvements

- **Security Features**

  - Secure authentication system
  - OTP-based password reset
  - Session management
  - Role-based authorization

- **Reporting & Analytics**
  - Leave statistics dashboard
  - Department-wise reports
  - PDF report generation
  - Export functionality

## 🛠️ Technology Stack

### Frontend

- HTML5
- CSS3
- JavaScript
- Bootstrap
- Chart.js (for analytics)

### Backend

- PHP 7.4+
- MySQL Database
- TCPDF (for PDF generation)

### AI & Integration

- OpenAI API
- Symfony HTTP Client
- PHPDotEnv

### Security

- Session-based authentication
- Password hashing
- Input validation
- XSS protection

## 🚀 Setup Instructions

1. **Prerequisites**

   - PHP 7.4 or higher
   - MySQL 5.7+
   - Composer
   - Web server (Apache/Nginx)

2. **Installation**

   ```bash
   # Clone the repository
   git clone [repository-url]

   # Install dependencies
   composer install

   # Configure environment
   cp .env.example .env
   # Edit .env with your database and OpenAI credentials

   # Import database
   mysql -u root -p db_leave < db_leave.sql
   ```

3. **Configuration**
   - Update database credentials in `conn.php`
   - Configure OpenAI API key in `.env`
   - Set up web server virtual host

## 📱 Usage

1. **Employee Portal**

   - Login with credentials
   - Apply for leave
   - Track application status
   - View leave balance

2. **HOD Interface**

   - Review department leave applications
   - Approve/reject requests
   - Generate department reports

3. **Dean's Dashboard**

   - Cross-department oversight
   - Leave approval workflow
   - Analytics and reporting

4. **Principal's Panel**
   - Final approval authority
   - Institutional overview
   - Policy management

## 📁 Project Structure

```
├── assets/          # Static assets
├── vendor/          # Composer dependencies
├── tcpdf/          # PDF generation library
├── *.php           # Core application files
└── docu/           # Documentation
```

## 🔒 Security Considerations

- Role-based access control
- Secure password reset flow
- Session management
- Input sanitization
- SQL injection prevention

## 🔮 Future Enhancements

- Mobile application development
- Email notifications
- Calendar integration
- Advanced analytics dashboard
- Bulk leave processing
- API development for third-party integration

## 📄 Test User credentials

role - Employee ID - password
Principal - 10001 - principal123
Academic Dean - 10002 - dean123
Head of Department - 10005 - hod123
employee - 10008 - Edith07!

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 🙏 Credits

- **OpenAI** - For AI-powered leave reason enhancement
- **TCPDF** - For PDF generation
- **Bootstrap** - For responsive UI components
- **Chart.js** - For analytics visualization

---

**Note**: This system is designed for educational institutions and implements best practices in leave management and workflow automation.
