import React from 'react';
import Navigation from '../components/Navigation';
import Logo from '../components/Logo';
import Footer from '../components/Footer';
import Filterscat from '../components/Filterscat';

const Sortcat = () => {
    return (
        <div className='sortcat'>
            <Logo />
            <Navigation/>
            <Filterscat></Filterscat>
            <Footer />
        </div>
    )
}

export default Sortcat;