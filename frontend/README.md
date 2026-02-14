# Frontend - React

## React, Angular, Vue

React est une librairie java script pour créer des interfaces utilisateur frontend. React requière une bonne maitrise de javaScript.

Angular est un framework pour créer des applications single page via TypeScript. Angular est un framework JavaScript open-source écrit en TypeScript et maintenu par Google.

VUE JS est un framework JavaScript pour la construction d'interfaces utilisateur.

React est un produit de Meta (facebook). ReactJS. Type script = JS avec types. LTS = Long Term support.

Pour installer React allez sur nodeJS, puis vérifier `node -v`, puis `npm -v` (Node Package Manager) pour télécharger des petites choses (pour les grandes : `npx` = Node Package Execute).

```bash
npx create-react-app application_name
```

### Installation

```bash
npm -v
# 6.14.18
npx -v
# 6.14.18
```

### Quelques commandes

- **npm start** — Starts the development server.
- **npm run build** — Bundles the app into static files for production.
- **npm test** — Starts the test runner.
- **npm run eject** — Removes this tool and copies build dependencies, configuration files and scripts into the app directory. If you do this, you can't go back!

```bash
cd application_name
npm start
# localhost:3000
```

Ouvrir le projet avec Visual Studio Code. `node_modules` : pour les modules non commités. `public` : ce qui est visible. `src` : répertoire du travail. `/usr/local/bin` is in your `$PATH`.

Une fonction React retourne une balise ; la fonction devient une balise.

---

## Contenu des fichiers

### index.js

```javascript
import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import MyApplication from './MyApplication';
import reportWebVitals from './reportWebVitals';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <MyApplication />
  </React.StrictMode>
);

reportWebVitals();
```

### MyApplication.js

```javascript
import {BrowserRouter, Routes, Route, Navigate} from 'react-router-dom';
import Etudiants  from './Modules/Etudiants';
import Etudiant  from './Modules/Etudiant';
import DelEtudiant  from './Modules/DelEtudiant';

import './App.css';

function MyApplication() {
  return (
  <BrowserRouter>
    <Routes>
       <Route path="/" element={<Navigate to="/etudiants"/>} />
       <Route path="/etudiants" element={<Etudiants/>} />
       <Route path="/etudiants/show/:id" element={<Etudiant/>} />
       <Route path="/etudiants/del/:id" element={<DelEtudiant/>} />
    </Routes>
  </BrowserRouter>
  );
}

export default MyApplication;
```

Créer un répertoire **Modules** dans le répertoire **src** et mettez le contenu à l'intérieur.

### Modules/Etudiants.js

```javascript
import {useState, useEffect} from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';
import '../CSS/Etudiants.css';

function Etudiants() {
    const [students, setStudents] = useState([]);

    const getGenderClass = (gender) => {
      return gender?.toLowerCase() === 'masculin' ? 'gender-male' : 'gender-female';
  };

    useEffect( () => {axios.get('http://127.0.0.1:8000/api/apiStudents')
            .then((response) => {setStudents(response.data.students);} ) } );
            return (
                <table className="students-table">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Genre</th>
                            <th>Adresse</th>
                            <th>Date de naissance</th>
                            <th>Note Bac</th>
                            <th>Filière</th>
                            <th align='center'>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {students.map(({photo, id, name, gender, address, birthDate, bacGrade, branch}) => (
                            <tr key={id}>
                                <td>
                                    <img 
                                        src={`http://localhost:8000/pictures/${photo || 'noPicture.jpeg'}`}
                                        alt={name}
                                        className="student-photo"
                                        onError={(e) => {
                                            e.target.src = 'http://localhost:8000/pictures/noPicture.jpeg';
                                        }}
                                    />
                                </td>
                                <td>{id}</td>
                                <td><strong>{name}</strong></td>
                                <td>
                                    <span className={`gender-badge ${getGenderClass(gender)}`}>
                                        {gender}
                                    </span>
                                </td>
                                <td>{address}</td>
                                <td>{birthDate}</td>
                                <td>
                                    <span className="grade-badge">{bacGrade}</span>
                                </td>
                                <td>
                                    <span className="branch-tag">{branch}</span>
                                </td>
                                <td>
                                    <div className="actions">
                                        <Link to={`/etudiants/show/${id}`}>
                                            <button className="btn btn-show">Show</button>
                                        </Link>
                                        <button className="btn btn-edit">Update</button>
                                        <Link to={`/etudiants/del/${id}`}>
                                            <button className="btn btn-delete">Delete</button>
                                        </Link>
                                    </div>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            );
        }

export default Etudiants;
```

### Modules/Etudiant.js

```javascript
import {useState, useEffect} from 'react';
import { Link, useParams } from 'react-router-dom';
import axios from 'axios';
import '../CSS/Etudiant.css';

function Etudiant() {
    const [student, setStudent] = useState(null);
    const [loading, setLoading] = useState(true);

    const {id} = useParams();

    const getGenderClass = (gender) => {
        return gender?.toLowerCase() === 'masculin' ? 'gender-male' : 'gender-female';
    };

    useEffect(() => {
        setLoading(true);
        axios.get('http://127.0.0.1:8000/api/apiStudents/'+id)
            .then((response) => {
                setStudent(response.data.student);
                setLoading(false);
            })
    }, [id]);

    if (loading) return <div className="loading">Chargement des données...</div>;
    return (
        <div className="student-card">
            <h2>Détails de l'étudiant</h2>
            
            <table className="vertical-table">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{id}</td>
                    </tr>
                    <tr>
                        <th>Nom complet</th>
                        <td><strong>{student.name}</strong></td>
                    </tr>
                    <tr>
                        <th>Genre</th>
                        <td>
                            <span className={`gender-badge ${getGenderClass(student.gender)}`}>
                                {student.gender}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Adresse</th>
                        <td>{student.address}</td>
                    </tr>
                    <tr>
                        <th>Date de naissance</th>
                        <td>{student.birthDate}</td>
                    </tr>
                    <tr>
                        <th>Note Bac</th>
                        <td>
                            <span className="grade-badge">{student.bacGrade}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Filière</th>
                        <td>
                            <span className="branch-tag">{student.branch}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Back</th>
                        <td>
                            <div className="actions">
                                <Link to={`/`}>
                                    <button className="btn btn-show">Back</button>
                                </Link>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    );
}

export default Etudiant;
```

### Modules/DelEtudiant.js

```javascript
import { useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import axios from 'axios';

function DelEtudiant() {
    const { id } = useParams();
    const navigate = useNavigate();

    useEffect(() => {
        const deleteStudent = async () => {
            try {
                await axios.delete(`http://127.0.0.1:8000/api/apiStudents/${id}`);
                navigate('/');
            } catch (error) {
                console.error('Erreur:', error);
                navigate('/');
            }
        };

        deleteStudent();
    }, [id, navigate]); 

    return null;
}

export default DelEtudiant;
```

Créer un répertoire **CSS** dans le répertoire **src** et mettez le contenu à l'intérieur.

### CSS/Etudiants.css

(Voir le fichier `src/CSS/Etudiants.css` dans le projet.)

### CSS/Etudiant.css

(Voir le fichier `src/CSS/Etudiant.css` dans le projet.)

### À rajouter (vous pouvez utiliser l'IA)

- **StudentForm.js** — Formulaire d'ajout d'un nouveau étudiant (script d'ajout dans le même fichier).
- **StudentEdit.js** — Modification d'un étudiant (script de modification dans le même fichier).
- **NoMatch.js** — Afficher "Page Not Found" pour les liens non disponibles.
- Pensez à sécuriser l'application.

---

# Getting Started with Create React App

This project was bootstrapped with [Create React App](https://github.com/facebook/create-react-app).

## Available Scripts

In the project directory, you can run:

### `npm start`

Runs the app in the development mode.\
Open [http://localhost:3000](http://localhost:3000) to view it in your browser.

The page will reload when you make changes.\
You may also see any lint errors in the console.

### `npm test`

Launches the test runner in the interactive watch mode.\
See the section about [running tests](https://facebook.github.io/create-react-app/docs/running-tests) for more information.

### `npm run build`

Builds the app for production to the `build` folder.\
It correctly bundles React in production mode and optimizes the build for the best performance.

The build is minified and the filenames include the hashes.\
Your app is ready to be deployed!

See the section about [deployment](https://facebook.github.io/create-react-app/docs/deployment) for more information.

### `npm run eject`

**Note: this is a one-way operation. Once you `eject`, you can't go back!**

If you aren't satisfied with the build tool and configuration choices, you can `eject` at any time. This command will remove the single build dependency from your project.

Instead, it will copy all the configuration files and the transitive dependencies (webpack, Babel, ESLint, etc) right into your project so you have full control over them. All of the commands except `eject` will still work, but they will point to the copied scripts so you can tweak them. At this point you're on your own.

You don't have to ever use `eject`. The curated feature set is suitable for small and middle deployments, and you shouldn't feel obligated to use this feature. However we understand that this tool wouldn't be useful if you couldn't customize it when you are ready for it.

## Learn More

You can learn more in the [Create React App documentation](https://facebook.github.io/create-react-app/docs/getting-started).

To learn React, check out the [React documentation](https://reactjs.org/).

### Code Splitting

This section has moved here: [https://facebook.github.io/create-react-app/docs/code-splitting](https://facebook.github.io/create-react-app/docs/code-splitting)

### Analyzing the Bundle Size

This section has moved here: [https://facebook.github.io/create-react-app/docs/analyzing-the-bundle-size](https://facebook.github.io/create-react-app/docs/analyzing-the-bundle-size)

### Making a Progressive Web App

This section has moved here: [https://facebook.github.io/create-react-app/docs/making-a-progressive-web-app](https://facebook.github.io/create-react-app/docs/making-a-progressive-web-app)

### Advanced Configuration

This section has moved here: [https://facebook.github.io/create-react-app/docs/advanced-configuration](https://facebook.github.io/create-react-app/docs/advanced-configuration)

### Deployment

This section has moved here: [https://facebook.github.io/create-react-app/docs/deployment](https://facebook.github.io/create-react-app/docs/deployment)

### `npm run build` fails to minify

This section has moved here: [https://facebook.github.io/create-react-app/docs/troubleshooting#npm-run-build-fails-to-minify](https://facebook.github.io/create-react-app/docs/troubleshooting#npm-run-build-fails-to-minify)
