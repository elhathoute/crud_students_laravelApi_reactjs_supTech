import { useState, useEffect } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import axios from 'axios';
import { getToken, removeToken } from '../auth';
import { API_BASE } from '../api';
import '../CSS/Etudiants.css';

function Etudiants() {
    const navigate = useNavigate();
    const [students, setStudents] = useState([]);

    const getGenderClass = (gender) => {
      return gender?.toLowerCase() === 'masculin' ? 'gender-male' : 'gender-female';
  };

    const baseUrl = API_BASE;
    const getPhotoUrl = (photo) =>
        photo && photo.startsWith('images/') ? `${baseUrl}/${photo}` : `${baseUrl}/pictures/${photo || 'noPicture.jpeg'}`;

    const handleLogout = () => {
        const token = getToken();
        if (token) {
            axios.post(`${API_BASE}/api/logout`, {}, { headers: { Authorization: 'Bearer ' + token } })
                .catch(() => {});
        }
        removeToken();
        delete axios.defaults.headers.common['Authorization'];
        navigate('/login');
    };

    useEffect(() => {
        axios.get(`${API_BASE}/api/apiStudents`)
            .then((response) => setStudents(response.data.students));
    }, []);

    return (
        <>
            <div className="top-actions">
                <div className="btn-add-student-wrap">
                    <Link to="/etudiants/create">
                        <button type="button" className="btn-add-student">Add student</button>
                    </Link>
                </div>
                {getToken() && (
                    <button type="button" className="btn-logout" onClick={handleLogout}>Déconnexion</button>
                )}
            </div>
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
                                        src={getPhotoUrl(photo)}
                                        alt={name}
                                        className="student-photo"
                                        onError={(e) => {
                                            e.target.src = `${baseUrl}/images/no-photo.jpg`;
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
                                        <Link to={`/etudiants/update/${id}`}>
                                        <button className="btn btn-edit">Update</button>
                                        </Link>
                                        <Link to={`/etudiants/del/${id}`}>
                                            <button className="btn btn-delete">Delete</button>
                                        </Link>
                                    </div>
                                </td>
                            </tr>
                        ))}
                    </tbody>
            </table>
        </>
    );
}

export default Etudiants;