<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 25px 30px;
            border-radius: 10px 10px 0 0;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            font-size: 2.5rem;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-left: 45px;
        }
        
        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
        
        .search-box {
            display: flex;
            align-items: center;
            flex-grow: 1;
            max-width: 400px;
        }
        
        .search-box input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px 0 0 5px;
            font-size: 16px;
        }
        
        .search-box button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }
        
        .btn-add {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.3s;
        }
        
        .btn-add:hover {
            background-color: #27ae60;
        }
        
        .table-container {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background-color: #2c3e50;
            color: white;
        }
        
        th {
            padding: 18px 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #3498db;
        }
        
        tbody tr {
            border-bottom: 1px solid #eee;
            transition: background-color 0.2s;
        }
        
        tbody tr:hover {
            background-color: #f9f9f9;
        }
        
        td {
            padding: 16px 15px;
        }
        
        .student-id {
            color: #3498db;
            font-weight: 600;
        }
        
        .name-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #3498db;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .gender {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .gender-male {
            background-color: #e3f2fd;
            color: #1976d2;
        }
        
        .gender-female {
            background-color: #fce4ec;
            color: #c2185b;
        }
        
        .gender-other {
            background-color: #f3e5f5;
            color: #7b1fa2;
        }
        
        .address {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .grade {
            font-weight: 600;
            color: #2c3e50;
        }
        
        .grade-excellent {
            color: #27ae60;
        }
        
        .grade-good {
            color: #f39c12;
        }
        
        .grade-average {
            color: #e74c3c;
        }
        
        .actions {
            display: flex;
            gap: 10px;
        }
        
        .btn-action {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.2s;
        }
        
        .btn-view {
            background-color: #3498db;
            color: white;
        }
        
        .btn-edit {
            background-color: #f39c12;
            color: white;
        }
        
        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }
        
        .btn-action:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
        
        .summary {
            display: flex;
            justify-content: space-between;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .summary-item {
            text-align: center;
            flex: 1;
            min-width: 150px;
        }
        
        .summary-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: #3498db;
        }
        
        .summary-label {
            font-size: 1rem;
            color: #7f8c8d;
            margin-top: 5px;
        }
        
        footer {
            text-align: center;
            margin-top: 40px;
            color: #95a5a6;
            font-size: 0.9rem;
        }
        
        .no-data {
            text-align: center;
            padding: 50px;
            color: #7f8c8d;
        }
        
        @media (max-width: 768px) {
            .controls {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-box {
                max-width: 100%;
            }
            
            th, td {
                padding: 12px 10px;
                font-size: 0.9rem;
            }
            
            .actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    @include('deconnection')
    <div class="container">
        <header>
            <h1><i class="fas fa-graduation-cap"></i> Student Records</h1>
            <p class="subtitle">Manage and view all student information in one place</p>
        </header>
        
        <div class="controls">
            <div class="search-box">
                <form action="{{route('student.search')}}">
                    @csrf
                <input type="text" id="searchInput" name="searchInput" placeholder="Search by name, ID, or address...">
                <button id="searchBtn"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <button class="btn-add" onclick="window.location.href='{{ route('studentForm')}}'">
                <i class="fas fa-user-plus"></i> Add New Student
            </button>
        </div>
        
        <div class="table-container">
            <table id="studentTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Date of Birth</th>
                        <th>BAC Grade</th>
                        <th>Branch</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    
                    @foreach($students as $student)
                    <tr>
                        <td class="student-id">{{ $student->id }}</td>
                        <td>
                            <div class="name-cell">
                                <div class="avatar">AJ</div>
                                <div>{{ $student->name }}</div>
                            </div>
                        </td>
                        <td><span class="gender gender-male">
                            @if($student->gender == 'm')
                                Male
                            @else
                                Female
                            @endif
                        </span></td>
                        <td class="address">{{ $student->address }}</td>
                        <td>{{ $student->birthDate }}</td>
                        <td><span class="grade grade-excellent">{{ $student->bacGrade }}</span></td>
                        <td class="address">{{ $student->branch->name ?? 'N/A' }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('viewStudent', ['id'=>$student->id])}}" onclick="return confirm('Do you want to View ?')">
                                <button class="btn-action btn-view"><i class="fas fa-eye"></i> View</button>
                                </a>
                                <a href="{{ route('editStudent', ['id'=>$student->id])}}" onclick="return confirm('Do you want to edit ?')">
                                <button class="btn-action btn-edit"><i class="fas fa-edit"></i> Edit</button>
                                </a>
                                <a href="{{ route('delStudent', ['id'=>$student->id])}}" onclick="return confirm('Do you want to delete ?')">
                                   <button class="btn-action btn-delete"><i class="fas fa-edit"></i> Delete</button>
                               </a>
                                
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
 
    </div>
</body>
</html>



