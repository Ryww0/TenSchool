import React from "react";

function Home() {

    return (
        <>
            <div className="container">
                <div className="home-welcome d-flex align-items-end">
                    <div className="text-end">
                        <h1>Le meilleur écosystème d'apprentissage en ligne</h1>
                        <h2>apprendre c'est partager</h2>
                    </div>
                </div>

                <div className="home-accordeon mb-5 position-relative">
                    <accordion-component></accordion-component>
                </div>
            </div>
        </>
    )
}

export default Home