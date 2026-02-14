import { useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import axios from 'axios';
import { API_BASE } from '../api';

function DelEtudiant() {
    const { id } = useParams();
    const navigate = useNavigate();

    useEffect(() => {
        const deleteStudent = async () => {
            try {
                await axios.delete(`${API_BASE}/api/apiStudents/${id}`);
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