import {BrowserRouter, Routes, Route, Navigate} from 'react-router-dom';
import Etudiants  from './Modules/Etudiants';
import Etudiant  from './Modules/Etudiant';
import DelEtudiant  from './Modules/DelEtudiant';
import StudentForm  from './Modules/StudentForm';
import NoMatch from './Modules/NoMatch';
import Login from './Modules/Login';
import Signup from './Modules/Signup';
import GeneratePdf from './Modules/GeneratePdf';

import './App.css';

function MyApplication() {
  return (
  <BrowserRouter>
    <Routes>
       <Route path="/" element={<Navigate to="/login"/>} />
       <Route path="/login" element={<Login/>} />
       <Route path="/register" element={<Signup/>} />
       <Route path="/etudiants" element={<Etudiants/>} />
       <Route path="/etudiants/show/:id" element={<Etudiant/>} />
       <Route path="/etudiants/del/:id" element={<DelEtudiant/>} />
       <Route path="/etudiants/create" element={<StudentForm/>} />
       <Route path="/etudiants/update/:id" element={<StudentForm/>} />
       <Route path="/generate-pdf/:id" element={<GeneratePdf/>} />
       <Route path="*" element={<NoMatch/>} />
    </Routes>
  </BrowserRouter>
  );
}

export default MyApplication;