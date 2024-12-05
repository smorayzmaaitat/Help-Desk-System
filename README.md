# Help Desk Ticketing System
## Introduction
The Help Desk Ticketing System is designed to streamline and enhance customer support by centralizing communication, improving accountability, and offering robust tracking. It helps manage inquiries, support requests, and service issues effectively.
 
## Features
### Core Components
- **User Roles**:
  - **End Users**: Submit and track tickets, communicate with technicians, and provide feedback.
  - **Technicians**: Manage assigned tickets, update statuses, and resolve issues.
  - **Supervisors**: Monitor performance, reassign tickets, and generate reports.
  - **Admins**: Manage user roles, system configurations, and security.
  
 
### Functionalities
- **End User Features**:
  - Intuitive ticket submission with file attachments.
  - Real-time ticket status tracking.
  - Communication channel with technicians.
  - **Real-Time Messaging**:
    - Instant chat within ticket context.
    - Live comment updates.
    - Live chat .

- **Technician Features**:
  - Ticket assignment and status updates.
  - Time tracking for resolution efficiency.
  - **Real-Time Notifications**:
    - Instant alerts for new tickets.
    - Push notifications across devices.
    - WebSocket-powered real-time updates.

- **Supervisor Features**:
  - Dashboard for monitoring tickets and metrics.
  - Performance reports and ticket reassignment tools.
  - **Real-Time Analytics**:
    - Live ticket status tracking.
    - Instant performance metric updates.

- **Admin Features**:
  - System Customization.
    - Application name
    - Color scheme/branding
    - Global notification settings
  - User management .
  - Role-based access control and compliance tools.
  - **Real-Time System Monitoring**:
    - Live user activity tracking.
    - Instant system health notifications.

### Non-Functional Requirements
- **Performance**: Handles up to 1,000 concurrent users.
- **Security**: Encrypted communications and secure password storage.
- **Scalability**: Modular design for growth.
- **Reliability**: 99.9% uptime with regular backups.

### Technology Stack
- **Frontend**: Vue.js, TailwindCSS, Inertia.js.
- **Backend**: Laravel with RESTful APIs.
- **Database**: PostgreSQL.
- **Real-Time Technologies**: WebSocket .

## Key Screens
- Login/Register
- User Dashboard
- Ticket Submission and Detail View
- Admin Panels
- Real-Time Chat Interface
 
## Deployment
1. Clone the repository:
   ```bash
   git clone https://github.com/smorayzmaaitat/Help-Desk-System.git
   cd help-desk-system
   mv .env.example .env
   docker-compose up --build
   ```
2. and open
   ```bash
   https://localhost:443
   ```

## Try the App

You can try the app by visiting the following URL:

[https://16.171.165.82](https://16.171.165.82)

### Login Credentials

- **Email**: admin@admin.com
- **Password**: adminadmin



