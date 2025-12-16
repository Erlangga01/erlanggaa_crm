# PT. Smart CRM

A Customer Relationship Management system for managing Leads, Projects, and Customers.

## Credentials
- **Manager**: `manager@smart.co.id` / `password`
- **Sales**: `sales@smart.co.id` / `password`

---

# Standard Operating Procedure (SOP) & CRM Workflow

This document outlines the step-by-step workflow for the PT. Smart CRM system, covering the lifecycle from Lead acquisition to Customer activation.

## Roles
- **Sales**: Responsible for finding, inputting, and converting Leads to Projects.
- **Manager**: Responsible for monitoring performance and approving/finalizing Projects.
- **Surveyor**: (Field Role) Responsible for physical installation.

## Workflow Steps

### 1. Lead Acquisition (Sales)
**Goal**: Record potential customer interest.
1.  **Login** as Sales Staff.
2.  Navigate to **Leads / Calon**.
3.  Click **"Tambah Lead Manual"**.
4.  Fill in the form:
    -   **Nama Customer**: Name of the potential client.
    -   **Alamat**: Installation address.
    -   **Kontak**: Email and Phone Number.
    -   **Produk Diminati**: Select the internet package.
5.  Click **"Simpan"**.
    -   *System Status*: `New`

### 2. Lead Processing (Sales)
**Goal**: Follow up and close the deal.
1.  Navigate to **Leads**.
2.  Locate the Lead. Use "Edit" to update status (e.g., to `Contacted` or `Qualified`) as negotiation progresses.
3.  **To Close Deal**: Click the **"Proses"** button on the Lead card.
4.  **Project Information Form**:
    -   **Paket yang Dipilih**: Confirm the final product.
    -   **Nama Surveyor**: Manual input of the technician assigned for installation (e.g., "Budi", "Team A").
    -   **Jadwal Instalasi**: Select the agreed installation date.
5.  Click **"Buat Project"**.
    -   *System Status*: Project created with status `Pending Approval`.
    -   *System Action*: Lead status updates to `Converted`.

### 3. Manager Approval (Manager)
**Goal**: Validate the sale and authorize installation.
1.  **Login** as Manager.
2.  Navigate to **Project & Approval** (or check Dashboard overview).
3.  Review projects with status `Pending Approval`.
4.  Click **"Approve"** (Checkmark icon).
    -   *System Status*: Project updates to `Installation`.
    -   *Note*: This signals the Surveyor to proceed.

### 4. Installation & Finalization (Manager/System)
**Goal**: Confirm physical installation and start subscription.
1.  **Offline Action**: Surveyor performs installation on the scheduled date.
2.  Upon successful installation reporting, Manager performs the final step.
3.  Navigate to **Project & Approval**.
4.  Locate the project with status `Installation`.
5.  Click **"Selesai & Aktifkan"** (Checkmark/Finish icon).
    -   *System Status*: Project updates to `Completed`.
    -   *System Action*: A new **Customer** record is created automatically with Active status.
    -   *System Action*: Subscription Start Date is set to today.

### 5. Monitoring & Analytics (Manager)
**Goal**: Track performance.
1.  Navigate to **Dashboard**.
2.  **Analisis Performa Section**:
    -   **Top Performing Sales**: View which Salesperson generates the most projects.
    -   **Instalasi per Surveyor**: View workload distribution among Surveyors based on the "Nama Surveyor" input.
3.  **Filters**: Use the filter bar to search specific Sales or Surveyor names to refine the data.

---

# System Diagrams

## Workflow Activity Diagram
This diagram illustrates the end-to-end flow from Lead generation to Customer activation.

```mermaid
stateDiagram-v2
    [*] --> Login_Sales: Sales Login
    Login_Sales --> Input_Lead: Create New Lead
    Input_Lead --> Process_Lead: Select Lead to Process
    
    state "Convert to Project" as Convert {
        Process_Lead --> Input_Details: Input Product & Surveyor
        Input_Details --> Create_Project: Submit
    }

    Create_Project --> Pending_Approval: Status = Pending Approval
    
    state "Manager Approval" as Approval {
        Pending_Approval --> Login_Manager: Manager Login
        Login_Manager --> View_Projects: View Pending Projects
        View_Projects --> Approve: Approve Project
    }

    Approve --> Installation: Status = Installation
    
    state "Installation & Completion" as Install {
        Installation --> Physical_Install: Surveyor Installs Device
        Physical_Install --> Finish_Install: Mark as Finished
    }

    Finish_Install --> Completed: Status = Completed
    Completed --> Create_Customer: System Creates Customer
    Create_Customer --> Active: Status = Active
    Active --> [*]
```

## Sequence Diagram
This diagram details the interactions between the Users, System Components (UI/Controllers), and the Database.

```mermaid
sequenceDiagram
    autonumber
    actor Sales
    actor Manager
    participant UI as Web Interface
    participant Ctrl as Controllers (Laravel)
    participant DB as Database

    %% Lead Creation
    Sales->>UI: Input New Lead
    UI->>Ctrl: POST /leads (store)
    Ctrl->>DB: INSERT into leads
    DB-->>Ctrl: Success
    Ctrl-->>UI: Show "Lead Created"

    %% Project Conversion
    Sales->>UI: Click "Process" on Lead
    UI->>Ctrl: GET /projects/create (with lead_id)
    Ctrl-->>UI: Show Project Form
    Sales->>UI: Select Product, Input Surveyor Name, Date
    UI->>Ctrl: POST /projects (store)
    Ctrl->>DB: INSERT into projects (status: Pending Approval, sales_id: Sales)
    Ctrl->>DB: UPDATE leads (status: Converted)
    DB-->>Ctrl: Success
    Ctrl-->>UI: Redirect to Project Index

    %% Manager Approval
    Manager->>UI: Login & View Projects
    UI->>Ctrl: GET /projects
    Ctrl->>DB: SELECT * FROM projects
    DB-->>Ctrl: Data
    Ctrl-->>UI: List Projects
    Manager->>UI: Click "Approve"
    UI->>Ctrl: POST /projects/{id}/approve
    Ctrl->>DB: UPDATE projects (status: Installation, is_manager_approved: true)
    DB-->>Ctrl: Success
    Ctrl-->>UI: Show "Approved"

    %% Finish Installation & Create Customer
    Manager->>UI: Click "Finish Installation"
    UI->>Ctrl: POST /projects/{id}/finish
    Ctrl->>DB: UPDATE projects (status: Completed)
    Ctrl->>DB: INSERT into customers (name, start_date, etc.)
    DB-->>Ctrl: Success
    Ctrl-->>UI: Redirect to Customers Index
```
