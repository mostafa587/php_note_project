# PHP Notes Application

This is a simple note-taking web application built using PHP and MySQL. It allows authenticated users to save their notes to a database and display them on the page. The application uses PHP sessions for user authentication.

## Features

- **User Authentication**: Users must be logged in to access the note-taking functionality.
- **Add Notes**: Users can submit notes, which are stored in a MySQL database.
- **Display Notes**: Notes are fetched from the database and displayed for the logged-in user.
- **Secure Input Handling**: User input is sanitized to prevent XSS attacks.

## Technologies Used

- PHP
- MySQL
- HTML
- Sessions for authentication

## Database Setup

The application requires a MySQL database with the following structure:

### Database: `mydata`

### Table: `notes`
| Column  | Type   | Description                |
|---------|--------|----------------------------|
| `id`    | INT    | User ID (from session)      |
| `note`  | TEXT   | The note text submitted by the user |

## How It Works

1. **Session Check**: 
   - The application checks for `$_SESSION['username']`, `$_SESSION['password']`, and `$_SESSION['id']`. If any are missing, the user is redirected to `login.html`.
   
2. **Note Submission**:
   - Users can submit notes via a form. The note is sanitized using `filter_var()` and then inserted into the MySQL database.
   
3. **Display Notes**:
   - The notes associated with the logged-in user are retrieved from the `notes` table and displayed on the page.

## Installation and Setup

### 1. Clone the Repository
```bash
git clone https://github.com/mostafa587/php_note_project.git
