import { useState, useEffect } from 'react';
import { Link, useNavigate, useParams } from 'react-router-dom';
import axios from 'axios';
import { API_BASE } from '../api';
import '../CSS/Etudiant.css';

function StudentForm() {
    const { id } = useParams();
    const navigate = useNavigate();
    const isUpdate = Boolean(id);

    const [branches, setBranches] = useState([]);
    const [loading, setLoading] = useState(true);
    const [sending, setSending] = useState(false);
    const [form, setForm] = useState({
        name: '',
        gender: '',
        address: '',
        birthDate: '',
        bacGrade: '',
        idBranch: '',
        photo: null
    });
    const [currentPhotoUrl, setCurrentPhotoUrl] = useState(null);

    useEffect(() => {
        axios.get(`${API_BASE}/api/branches`)
            .then((res) => setBranches(res.data || []))
            .catch(() => setBranches([]));
    }, []);

    useEffect(() => {
        if (!id) {
            setLoading(false);
            return;
        }
        setLoading(true);
        axios.get(`${API_BASE}/api/apiStudents/${id}`)
            .then((res) => {
                const s = res.data.student;
                if (s) {
                    const g = String(s.gender || '').toUpperCase().slice(0, 1);
                    setForm({
                        name: s.name ?? '',
                        gender: (g === 'M' || g === 'F') ? g : '',
                        address: s.address ?? '',
                        birthDate: (s.birthDate || '').slice(0, 10),
                        bacGrade: s.bacGrade ?? '',
                        idBranch: s.idBranch ?? '',
                        photo: null
                    });
                    const photo = s.photo;
                    if (photo && photo.startsWith('images/')) {
                        setCurrentPhotoUrl(`${API_BASE}/${photo}`);
                    } else if (photo) {
                        setCurrentPhotoUrl(`${API_BASE}/pictures/${photo}`);
                    } else {
                        setCurrentPhotoUrl(`${API_BASE}/images/no-photo.jpg`);
                    }
                }
            })
            .catch(() => setCurrentPhotoUrl(null))
            .finally(() => setLoading(false));
    }, [id]);

    const handleChange = (e) => {
        const { name, value, type, files } = e.target;
        setForm((prev) => ({
            ...prev,
            [name]: type === 'file' ? (files && files[0]) || null : value
        }));
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        setSending(true);
        const data = new FormData();
        data.append('name', form.name);
        data.append('gender', form.gender);
        data.append('address', form.address);
        data.append('birthDate', form.birthDate);
        data.append('bacGrade', form.bacGrade);
        data.append('idBranch', form.idBranch);
        if (form.photo) data.append('photo', form.photo);

        const url = isUpdate
            ? `${API_BASE}/api/apiStudents/${id}`
            : `${API_BASE}/api/apiStudents`;

        const request = isUpdate
            ? axios.put(url, data, { headers: { 'Content-Type': 'multipart/form-data' } })
            : axios.post(url, data, { headers: { 'Content-Type': 'multipart/form-data' } });

        request
            .then(() => navigate('/etudiants'))
            .catch((err) => {
                console.error(err);
                setSending(false);
            });
    };

    if (loading) return <div className="loading">Chargement...</div>;

    return (
        <div className="student-card">
            <h2>{isUpdate ? 'Modifier l\'étudiant' : 'Ajouter un étudiant'}</h2>

            <form className="student-form" onSubmit={handleSubmit}>
                <div className="form-group">
                    <label htmlFor="name">Nom complet</label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        value={form.name}
                        onChange={handleChange}
                        placeholder="Nom complet"
                        required
                        className="form-input"
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="gender">Genre</label>
                    <select
                        id="gender"
                        name="gender"
                        value={form.gender}
                        onChange={handleChange}
                        required
                        className="form-input"
                    >
                        <option value="">-- Choisir --</option>
                        <option value="M" selected={form.gender === 'M'}>Masculin</option>
                        <option value="F" selected={form.gender === 'F'}>Féminin</option>
                    </select>
                </div>
                <div className="form-group">
                    <label htmlFor="address">Adresse</label>
                    <textarea
                        id="address"
                        name="address"
                        value={form.address}
                        onChange={handleChange}
                        placeholder="Adresse"
                        required
                        rows={3}
                        className="form-input"
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="birthDate">Date de naissance</label>
                    <input
                        id="birthDate"
                        name="birthDate"
                        type="date"
                        value={form.birthDate}
                        onChange={handleChange}
                        required
                        className="form-input"
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="bacGrade">Note Bac</label>
                    <input
                        id="bacGrade"
                        name="bacGrade"
                        type="number"
                        min={0}
                        max={20}
                        step={0.01}
                        value={form.bacGrade}
                        onChange={handleChange}
                        placeholder="0–20"
                        required
                        className="form-input"
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="idBranch">Filière</label>
                    <select
                        id="idBranch"
                        name="idBranch"
                        value={form.idBranch}
                        onChange={handleChange}
                        required
                        className="form-input"
                    >
                        <option value="">-- Choisir une filière --</option>
                        {branches.map((b) => (
                            <option key={b.id} value={b.id}>{b.name}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group">
                    <label htmlFor="photo">Photo</label>
                    {isUpdate && currentPhotoUrl && (
                        <div className="current-photo-wrap">
                            <img src={currentPhotoUrl} alt="Photo actuelle" className="current-photo" />
                            <span className="photo-hint">Choisir un fichier pour remplacer</span>
                        </div>
                    )}
                    <input
                        id="photo"
                        name="photo"
                        type="file"
                        accept="image/jpeg,image/jpg,image/png"
                        onChange={handleChange}
                        required={!isUpdate}
                        className="form-input"
                    />
                </div>
                <div className="form-actions">
                    <button type="submit" className="btn btn-show" disabled={sending}>
                        {sending ? 'Envoi...' : (isUpdate ? 'Enregistrer' : 'Créer')}
                    </button>
                    <Link to="/etudiants">
                        <button type="button" className="btn btn-show">Annuler</button>
                    </Link>
                </div>
            </form>
        </div>
    );
}

export default StudentForm;
