import {useState, useEffect} from 'react';
import { Link, useParams } from 'react-router-dom';
import axios from 'axios';
import { API_BASE } from '../api';
import '../CSS/Etudiant.css';


function Etudiant() {
    const [student, setStudent] = useState(null);
    const [loading, setLoading] = useState(true);

    const {id} = useParams();

    const getGenderClass = (gender) => {
        return gender?.toLowerCase() === 'masculin' ? 'gender-male' : 'gender-female';
    };

    const getPhotoUrl = (photo) =>
        photo && photo.startsWith('images/') ? `${API_BASE}/${photo}` : `${API_BASE}/pictures/${photo || 'noPicture.jpeg'}`;

    const handleGeneratePdf = (studentId) => {
        axios.get(`${API_BASE}/api/generate-pdf/${studentId}`, { responseType: 'blob' })
            .then((response) => {
                if (response.status === 200) {
                    const blob = new Blob([response.data], { type: 'application/pdf' });
                    const url = window.URL.createObjectURL(blob);
                    window.open(url, '_blank');
                    window.URL.revokeObjectURL(url);
                }
            })
            .catch((err) => console.error('Error generating PDF:', err));
    };

    useEffect(() => {
        setLoading(true);
        axios.get(`${API_BASE}/api/apiStudents/${id}`)
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
                        <th>Photo</th>
                        <td>
                            <img
                                src={getPhotoUrl(student.photo)}
                                alt={student.name}
                                className="student-photo-detail"
                                onError={(e) => {
                                    e.target.src = `${API_BASE}/images/no-photo.jpg`;
                                }}
                            />
                        </td>
                    </tr>
                    <tr>
                        <th>Back</th>
                        <td style={{display: 'flex', gap: '10px'}}>
                            <div className="actions">
                                <Link to={`/`}>
                                    <button className="btn btn-show">Back</button>
                                </Link>
                            </div>

                            <div className="actions">
                                    <button type="button" className="btn btn-show" onClick={() => handleGeneratePdf(id)}>Generate PDF</button>
                            </div>
                        </td>

                
                    </tr>
                </tbody>
            </table>
        </div>
    );
}

export default Etudiant;