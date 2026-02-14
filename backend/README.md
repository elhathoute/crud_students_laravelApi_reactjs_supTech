<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## API Students - Configuration

### 1. Installer l'API Laravel

```bash
php artisan install:api
```

### 2. Fichier routes/api.php

```php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiStudentsController;

Route::apiResource('/apiStudents', ApiStudentsController::class);
```

### 3. Controller ApiStudentsController

Créer le controller : `php artisan make:controller ApiStudentsController`

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Resources\StudentResource;

class ApiStudentsController extends Controller
{
    public function index()
    {
        return ['students'=>StudentResource::collection(Student::all())];
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=> 'required|string|min:2',
            'gender'=> 'required|string|in:M,F',
            'address'=> 'required',
            'birthDate' => 'required|date',
            'bacGrade'=> 'required|numeric|between:0,20',
            'idBranch'=> 'required|int',
            'photo' => 'required|mimes:jpeg,jpg,png|max:10024'
        ]);

        $photo = $request->file('photo');
        $photoName= uniqid().".".$photo->getClientOriginalExtension();
        $photo->move(public_path('pictures/') , $photoName); 
        $validated['photo'] =  $photoName;
        
        Student::create($validated);
        print_r($validated);
    }

    public function show(string $id)
    {
        $student = Student::find($id);
        return ['student' => StudentResource::make($student)];
    }

    public function update(Request $request, string $id)
    {
        // update
    }

    public function destroy(string $id)
    {
        $student = Student::find($id);
        $student->delete();
        return response()->json(['delete'=>true, 'code'=>200]);
    }
}
```

### 4. Resource StudentResource

Créer la resource : `php artisan make:resource StudentResource`

```php
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
```

### 5. Modèle Student — attribut $fillable

```php
<?php

namespace App\Models;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'gender', 'address', 'birthDate', 'bacGrade', 'idBranch', 'photo'];

    public function branch()
    {
        return $this->hasOne(Branch::class, 'id', 'idBranch');
    }
}
```

### 6. Tester avec Postman

- **GET** `localhost/project/api/apiStudents` — récupérer tous les étudiants (JSON)
- **GET** `localhost/project/api/apiStudents/id` — récupérer un étudiant (JSON)
- **POST** `localhost/project/api/apiStudents` — créer un étudiant (renseigner les données dans Postman)
- **PUT** `localhost/project/api/apiStudents/id` — modifier un étudiant (renseigner les nouvelles données)
- **DELETE** `localhost/project/api/apiStudents/id` — supprimer un étudiant

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
