import { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import axios from 'axios';
import { setToken } from '../auth';
import { API_BASE } from '../api';
import '../CSS/Auth.css';

function Signup() {
    const navigate = useNavigate();
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [password_confirmation, setPasswordConfirmation] = useState('');
    const [error, setError] = useState('');
    const [loading, setLoading] = useState(false);

    const handleSubmit = (e) => {
        e.preventDefault();
        setError('');
        if (password !== password_confirmation) {
            setError('Les mots de passe ne correspondent pas.');
            return;
        }
        setLoading(true);
        axios.post(`${API_BASE}/api/register`, {
            name,
            email,
            password,
            password_confirmation
        })
            .then((res) => {
                const t = res.data.token;
                setToken(t);
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + t;
                navigate('/etudiants');
            })
            .catch((err) => {
                const msg = err.response?.data?.message
                    || (err.response?.data?.errors && Object.values(err.response.data.errors).flat().join(' '))
                    || 'Erreur lors de l\'inscription.';
                setError(msg);
                setLoading(false);
            });
    };

    return (
        <div className="auth-box">
            <h2>Sign up</h2>
            <form className="auth-form" onSubmit={handleSubmit}>
                <div className="form-group">
                    <label htmlFor="name">Name</label>
                    <input
                        id="name"
                        type="text"
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                        required
                        autoComplete="name"
                        className="form-input"
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        required
                        autoComplete="email"
                        className="form-input"
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        required
                        minLength={8}
                        autoComplete="new-password"
                        className="form-input"
                    />
                </div>
                <div className="form-group">
                    <label htmlFor="password_confirmation">Confirm password</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        value={password_confirmation}
                        onChange={(e) => setPasswordConfirmation(e.target.value)}
                        required
                        minLength={8}
                        autoComplete="new-password"
                        className="form-input"
                    />
                </div>
                {error && <p className="auth-error">{error}</p>}
                <button type="submit" className="auth-btn" disabled={loading}>
                    {loading ? 'Inscription...' : 'Sign up'}
                </button>
            </form>
            <div className="auth-links">
                <Link to="/login">Already have an account? Login</Link>
            </div>
        </div>
    );
}

export default Signup;
