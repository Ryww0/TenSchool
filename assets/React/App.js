import React, {useState, useEffect} from 'react';
import {BrowserRouter as Router, Routes, Route} from "react-router-dom";
import Header from "./Components/header/header";
import Home from "./Components/home/Home";
import Footer from "./Components/footer/footer";

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
                <Footer/>
            </Router>
        </>
    );
}

export default App;