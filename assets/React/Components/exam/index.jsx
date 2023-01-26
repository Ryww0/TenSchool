import React, {useEffect, useState} from "react";

const Tests = () => {
    const [tests, setTests] = useState([]);

    const API_URL = 'http://127.0.0.1:8000/api';
    const id = userID;

    useEffect(() => {
        fetch(`${API_URL}/tests/${id}`)
            .then(response => response.json())
            .then(data => {
                setTests(JSON.parse(data))
            })
    }, []);

    console.log(tests)
    return (
        <div className="container tests-page pt-5 pb-5">
            <h1>Mes évaluations</h1>
            <div>
                {
                    // tests.classroom?.tests.map(test => (
                    //     <div key={test.id} className="card-test ps-3">
                    //         <h4>{test.title}</h4>
                    //         <div>
                    //             <a href="">voir la correction</a>
                    //         </div>
                    //     </div>
                    // ))
                }
            </div>
        </div>
    )
}

export default Tests