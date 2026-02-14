<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Étudiant #{{ $student->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; padding: 20px; }
        h1 { color: #333; }
        table { border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px 12px; text-align: left; }
        th { background: #4a6fa5; color: white; }
        img { max-width: 120px; max-height: 120px; border-radius: 8px; }
    </style>
</head>
<body>
    <h1>Fiche étudiant</h1>
    <table>
        <tr><th>ID</th><td>{{ $student->id }}</td></tr>
        <tr><th>Nom</th><td>{{ $student->name }}</td></tr>
        <tr><th>Genre</th><td>{{ $student->gender }}</td></tr>
        <tr><th>Adresse</th><td>{{ $student->address }}</td></tr>
        <tr><th>Date de naissance</th><td>{{ $student->birthDate }}</td></tr>
        <tr><th>Note Bac</th><td>{{ $student->bacGrade }}</td></tr>
        <tr><th>Filière</th><td>{{ $student->branch->name ?? '-' }}</td></tr>
        <tr><th>Photo</th><td>@if($photoPath && file_exists($photoPath))<img src="{{ $photoPath }}" alt="Photo" style="max-width:120px;max-height:120px;" />@else—@endif</td></tr>
    </table>
</body>
</html>
