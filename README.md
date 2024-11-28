<<<<<<< HEAD
<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
=======
# Help Desk Ticketing System
>>>>>>> 6bf62ce964978d50f7547ac730a275ea9c228ad3

A robust and scalable **Help Desk Ticketing System** designed to streamline and enhance the process of managing customer inquiries, support requests, and service issues. This system is built to improve service quality, accountability, and customer satisfaction.

## Table of Contents
- [Introduction](#introduction)
- [Features](#features)
- [Core Components](#core-components)
- [Technology Stack](#technology-stack)
- [Database Schema](#database-schema)
- [Setup and Installation](#setup-and-installation)
- [Contribution Guidelines](#contribution-guidelines)
- [License](#license)

---

## Introduction

The Help Desk Ticketing System aims to:
- **Centralize communication** by consolidating customer interactions.
- **Enhance accountability** by assigning tickets to specific support agents.
- **Improve response times** with prioritized ticket handling.
- **Enable tracking and reporting** for continuous improvement.
- **Scale** with organizational growth while maintaining service quality.

This project is structured to support different user roles: **End Users**, **Technicians**, **Supervisors**, and **Administrators**, ensuring role-specific features and functionalities.

---

## Features

### **End Users (Employees)**
- Submit support tickets with details like category, priority, and attachments.
- Track the status of their tickets in real-time.
- Communicate with technicians via a built-in comment system.
- Provide feedback through satisfaction surveys.

### **Technicians**
- Manage assigned tickets with status updates and time tracking.
- Add notes and solutions to ticket history.
- Communicate with end users efficiently.

### **Supervisors**
- Monitor ticket progress and technician performance.
- Reassign tickets and generate performance reports.
- Track SLA adherence and escalate critical issues.

### **System Administrators**
- Manage user accounts, roles, and permissions.
- Configure system settings, categories, and priorities.
- Ensure system security and compliance.

---

## Core Components

1. **Ticket Management**: End-to-end lifecycle of ticket submission, assignment, resolution, and closure.
2. **User Roles**:
   - **End Users**: Submit and track tickets.
   - **Technicians**: Resolve tickets and update statuses.
   - **Supervisors**: Monitor and manage overall ticket performance.
   - **Administrators**: Manage system configurations and user accounts.
3. **Dashboard**: Role-specific dashboards for tracking tickets, statistics, and activities.
4. **Surveys**: Collect feedback from users to measure satisfaction and resolution quality.
5. **Reports**: Generate detailed reports for analysis and performance tracking.

---

## Technology Stack

- **Frontend**:
  - [Vue.js](https://vuejs.org/) for interactive and responsive user interfaces.
  - [TailwindCSS](https://tailwindcss.com/) for modern and efficient styling.
  - [Inertia.js](https://inertiajs.com/) for seamless SPA experience.

- **Backend**:
  - [Laravel](https://laravel.com/) for powerful backend logic and RESTful API development.

- **Database**:
  - [MySQL](https://www.mysql.com/) or [PostgreSQL](https://www.postgresql.org/) for relational data management.

<<<<<<< HEAD
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
# Help Desk Ticketing System

A robust and scalable **Help Desk Ticketing System** designed to streamline and enhance the process of managing customer inquiries, support requests, and service issues. This system is built to improve service quality, accountability, and customer satisfaction.

## Table of Contents
- [Introduction](#introduction)
- [Features](#features)
- [Core Components](#core-components)
- [Technology Stack](#technology-stack)
- [Database Schema](#database-schema)
- [Setup and Installation](#setup-and-installation)
- [Contribution Guidelines](#contribution-guidelines)
- [License](#license)

---

## Introduction

The Help Desk Ticketing System aims to:
- **Centralize communication** by consolidating customer interactions.
- **Enhance accountability** by assigning tickets to specific support agents.
- **Improve response times** with prioritized ticket handling.
- **Enable tracking and reporting** for continuous improvement.
- **Scale** with organizational growth while maintaining service quality.

This project is structured to support different user roles: **End Users**, **Technicians**, **Supervisors**, and **Administrators**, ensuring role-specific features and functionalities.

---

## Features

### **End Users (Employees)**
- Submit support tickets with details like category, priority, and attachments.
- Track the status of their tickets in real-time.
- Communicate with technicians via a built-in comment system.
- Provide feedback through satisfaction surveys.

### **Technicians**
- Manage assigned tickets with status updates and time tracking.
- Add notes and solutions to ticket history.
- Communicate with end users efficiently.

### **Supervisors**
- Monitor ticket progress and technician performance.
- Reassign tickets and generate performance reports.
- Track SLA adherence and escalate critical issues.

### **System Administrators**
- Manage user accounts, roles, and permissions.
- Configure system settings, categories, and priorities.
- Ensure system security and compliance.

---

## Core Components

1. **Ticket Management**: End-to-end lifecycle of ticket submission, assignment, resolution, and closure.
2. **User Roles**:
   - **End Users**: Submit and track tickets.
   - **Technicians**: Resolve tickets and update statuses.
   - **Supervisors**: Monitor and manage overall ticket performance.
   - **Administrators**: Manage system configurations and user accounts.
3. **Dashboard**: Role-specific dashboards for tracking tickets, statistics, and activities.
4. **Surveys**: Collect feedback from users to measure satisfaction and resolution quality.
5. **Reports**: Generate detailed reports for analysis and performance tracking.

---

## Technology Stack

- **Frontend**:
  - [Vue.js](https://vuejs.org/) for interactive and responsive user interfaces.
  - [TailwindCSS](https://tailwindcss.com/) for modern and efficient styling.
  - [Inertia.js](https://inertiajs.com/) for seamless SPA experience.

- **Backend**:
  - [Laravel](https://laravel.com/) for powerful backend logic and RESTful API development.

- **Database**:
  - [MySQL](https://www.mysql.com/) or [PostgreSQL](https://www.postgresql.org/) for relational data management.

=======
>>>>>>> 6bf62ce964978d50f7547ac730a275ea9c228ad3
---

## Database Schema

### **Users Table**
Manages user accounts, roles, and departments.

### **Tickets Table**
Tracks ticket details, including status, priority, and assignment.

### **Ticket History Table**
Logs all actions performed on tickets for accountability.

### **Categories Table**
Stores ticket categories for easy classification and management.

### **Surveys Table**
Captures user feedback to assess support quality.

### **Attachments Table**
Manages ticket-related file uploads.

Refer to the [Requirements Specification](./docs/requirements.md) for detailed schema descriptions.

---

## Setup and Installation

### Prerequisites
- PHP >= 8.3
- Composer
- Node.js & npm
- MySQL or PostgreSQL
- Docker (Optional)

### Installation Steps
1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-username/help-desk-system.git
   cd help-desk-system
   docker-compose up --build
<<<<<<< HEAD
>>>>>>> 27d33119dfe8314aa5bd8c1c7b4ae5a70cd8e069
=======
>>>>>>> 6bf62ce964978d50f7547ac730a275ea9c228ad3
