import React from 'react';
import Navigation from '../components/Navigation';
import Logo from '../components/Logo';
import Footer from '../components/Footer';
import Magasins from '../components/Magasins';


const Add = () => {
    return (
        <div className='add'>
            <Logo />
            <Navigation />
            <Magasins />
            <Footer />
        </div>
    )
}

export default Add;