import React from 'react';
import { BrowserRouter, Switch, Route } from 'react-router-dom';
import All from './pages/All';
import Add from './pages/Add';
import Sortcat from './pages/Sortcat';
import Sortprix from './pages/Sortprix';

const App = () => {
  return (
    <BrowserRouter>
    <Switch>
      <Route path='/' exact component={All}/>
      <Route path='/add' exact component={Add}/>
      <Route path='/sortcat' exact component={Sortcat}/>
      <Route path='/sortprix' exact component={Sortprix}/>
    </Switch>
    </BrowserRouter>
  )
}

export default App;