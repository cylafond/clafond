import React from 'react';
import { NavLink } from 'react-router-dom';
const Navigation = () => {
    return (
        <div className='menu'>
            <div className='examen1'>
                <h2>Examen 2</h2>
            </div>
            <div className='navigation'>
                <NavLink exact to='/' activeClassName='nav-active'>
                    All
                </NavLink>
                <NavLink exact to='/add' activeClassName='nav-active'>
                    Add 
                </NavLink>
                <NavLink exact to='/sortcat' activeClassName='nav-active'>
                    Sortcat
                </NavLink>
                <NavLink exact to='/sortprix' activeClassName='nav-active'>
                    Sortprix
                </NavLink>
            </div>
        </div>
    )
}

export default Navigation;