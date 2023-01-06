import React, {useState, useEffect} from 'react';
import {BrowserRouter as Router, Routes, Route} from "react-router-dom";
import Header from "./Components/header/header";
import Home from "./Components/home/Home";

const API_URL = 'http://localhost:8000/api';

function App() {

    return (
        <>
            <Router>
                    <Header/>
                <Routes>
                    <Route path="/" element={<Home/>}/>
                    {/*<Route path="/login" element={<Login/>}/>*/}
                </Routes>
            </Router>
        </>
    );
}

export default App;