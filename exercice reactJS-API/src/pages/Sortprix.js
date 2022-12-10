import React from 'react';
import Navigation from '../components/Navigation';
import Logo from '../components/Logo';
import Footer from '../components/Footer';
import Filtersprix from '../components/Filtersprix';

const Sortprix = () => {
    return (
        <div className='sortprix'>
            <Logo />
            <Navigation/>
            <Filtersprix />
            <Footer />
        </div>
    )
}

export default Sortprix;