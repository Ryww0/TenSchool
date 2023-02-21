import React, {useEffect, useState} from "react";
import {Link} from "react-router-dom";

const Index = () => {
    const [tests, setTests] = useState([]);

    const API_URL = 'http://127.0.0.1:8000/api/back';

    useEffect(() => {
        fetch(`${API_URL}/tests`)
            .then(response => response.json())
            .then(data => {
                setTests(JSON.parse(data))
            })
    }, [])

    return (
        <main className='office'>
            <div className="d-flex justify-content-between align-items-center">
                <h1>Évaluation</h1>
                <Link className="button-create" to="/admin/dashboard/test/create">
                    <svg viewBox="0 0 226 226" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fillRule="evenodd" clipRule="evenodd" d="M85.5 199.002C85.5 213.362 97.1406 225.002 111.5 225.002C125.859 225.002 137.5 213.362 137.5 199.002V136H199.002C213.362 136 225.002 124.359 225.002 110C225.002 95.6406 213.362 84 199.002 84H137.5V26C137.5 11.6406 125.859 0 111.5 0C97.1406 0 85.5 11.6406 85.5 26V84H26C11.6406 84 0 95.6406 0 110C0 124.359 11.6406 136 26 136H85.5V199.002Z" fill="#1B4332"/>
                    </svg>
                </Link>
            </div>
            <ul>
                {
                    tests?.map(test => (
                        <li key={test.id}>{test.title}</li>
                    ))
                }
            </ul>
        </main>
    )
}

export default Index