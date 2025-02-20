# Project Documentation: Batch Upload System

## Overview
This project implements a **batch upload system** using **Laravel (backend)** and **React.js (frontend)**.

Users can upload an Excel file containing batch records, which are processed and stored in the database.

## Tech Stack
- **Backend**: Laravel (API-based architecture)
- **Frontend**: React.js (with API integration)
- **Database**: MySQL
- **File Upload**: Laravel Excel package

---

# Backend (Laravel)

## API Endpoints

### 1. **Upload Batch Data**
**Endpoint**: `POST /upload-batch`

**Description**: Uploads an Excel file containing batch records and stores the data in the database.

**Request Format**:
- **Headers**: `Content-Type: multipart/form-data`
- **Body**:
  - `file`: Excel file (required)

**Response Example**:
```json
{
  "message": "Batch uploaded successfully",
  "batch_id": 1
}
```

---

### 2. **Get All Batches**
**Endpoint**: `GET /batches`

**Description**: Retrieves a list of all uploaded batches.

**Response Example**:
```json
[
  {
    "id": 1,
    "record": 100,
    "remarks": "First batch",
    "status": "completed",
    "created_at": "2025-02-21T12:00:00Z"
  },
  {
    "id": 2,
    "record": 50,
    "remarks": "Second batch",
    "status": "pending",
    "created_at": "2025-02-21T13:00:00Z"
  }
]
```

---

### 3. **Get Batch Records**
**Endpoint**: `GET /batch-records/{batch_id}`

**Description**: Retrieves all records for a given batch ID.

**Response Example**:
```json
[
  {
    "id": 1,
    "batch_id": 1,
    "city": "Lahore",
    "society": "DHA",
    "block": "A",
    "marla": "10",
    "size": "500 sqft",
    "price": "5000000",
    "status": "active"
  },
  {
    "id": 2,
    "batch_id": 1,
    "city": "Karachi",
    "society": "Bahria Town",
    "block": "B",
    "marla": "5",
    "size": "250 sqft",
    "price": "2500000",
    "status": "active"
  }
]
```

---

# Frontend (React.js)

## Pages

### 1. **Batches Table (Home Page)**
- Displays all batches in a table
- Fetches data from `GET /batches`

### 2. **Batch Records Page**
- Displays all records of a selected batch
- Fetches data from `GET /batch-records/{batch_id}`

## API Integration in React

### Fetch Batches
```javascript
useEffect(() => {
  fetch("http://localhost:8000/api/batches")
    .then((res) => res.json())
    .then((data) => setBatches(data));
}, []);
```

### Fetch Batch Records
```javascript
useEffect(() => {
  fetch(`http://localhost:8000/api/batch-records/${batchId}`)
    .then((res) => res.json())
    .then((data) => setBatchRecords(data));
}, [batchId]);
```

### Upload Batch
```javascript
const handleFileUpload = async (file) => {
  const formData = new FormData();
  formData.append("file", file);

  const response = await fetch("http://localhost:8000/api/upload-batch", {
    method: "POST",
    body: formData,
  });
  const data = await response.json();
  console.log(data);
};
```

---

## Conclusion
This project enables **bulk data upload** using an **Excel file**, stores it as **batches**, and allows users to view and retrieve the stored data through a **React frontend**. The system is built for scalability using **Laravel queue jobs**.

For further improvements, consider adding **error handling**, **authentication**, and **pagination** for large datasets.

