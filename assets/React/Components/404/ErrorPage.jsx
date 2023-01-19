import React from "react";

const ErrorPage = () => {
    return (
        <>
            <div className="container d-flex flex-column justify-content-center align-items-center" style={{height: '100vh'}}>
                <span style={{fontSize: '10rem'}}>
                    404
                </span>
                <p>oops, on dirait que cette page n'existe pas !</p>
                <a href="/">retourner à l'accueil</a>
            </div>
        </>
    );
}

export default ErrorPage;