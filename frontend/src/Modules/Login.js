import { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import axios from 'axios';
import { setToken } from '../auth';
import { API_BASE } from '../api';
import '../CSS/Auth.css';

function Login() {
    const navigate = useNavigate();
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState('');
    const [loading, setLoading] = useState(false);

    const handleSubmit = (e) => {
        e.preventDefault();
        setError('');
        setLoading(true);
        axios.post(`${API_BASE}/api/login`, { email, password })
            .then((res) => {
                const t = res.data.token;
                setToken(t);
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + t;
                navigate('/etudiants');
            })
            .catch((err) => {
                setError(err.response?.data?.message || err.response?.data?.errors?.email?.[0] || 'Email ou mot de passe incorrect.');
                setLoading(false);
            });
    };

    return (
        <div className="auth-box">
            <h2>Login</h2>
            <form className="auth-form" onSubmit={handleSubmit}>
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
                        autoComplete="current-password"
                        className="form-input"
                    />
                </div>
                {error && <p className="auth-error">{error}</p>}
                <button type="submit" className="auth-btn" disabled={loading}>
                    {loading ? 'Connexion...' : 'Login'}
                </button>
            </form>
            <div className="auth-links">
                <Link to="/register">Sign up</Link>
            </div>
        </div>
    );
}

export default Login;
