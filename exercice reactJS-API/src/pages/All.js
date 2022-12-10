import React from 'react';
import Navigation from '../components/Navigation';
import Logo from '../components/Logo';
import Footer from '../components/Footer';
import List from '../components/List';

const All = () => {
    return (
        <div className='all'>
            <Logo />
            <Navigation/>
            <List></List>
            <Footer />
        </div>
    )
}

export default All;