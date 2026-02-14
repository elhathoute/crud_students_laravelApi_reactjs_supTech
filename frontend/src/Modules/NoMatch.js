import { Link } from 'react-router-dom';

function NoMatch() {
    return (
        <div className="no-match">
            <h1>404</h1>
            <p>Page non trouvée</p>
            <Link to="/etudiants">
                <button type="button" className="btn btn-show">Retour à la liste</button>
            </Link>
        </div>
    );
}

export default NoMatch;
