import React from 'react';
import ReactDOM from 'react-dom/client';
import axios from 'axios';
import { getToken } from './auth';
import './index.css';
import MyApplication from './MyApplication';
import reportWebVitals from './reportWebVitals';

const token = getToken();
if (token) {
  axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
}

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <MyApplication />
  </React.StrictMode>
);

reportWebVitals();