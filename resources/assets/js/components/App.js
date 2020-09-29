import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import Header from './Header'
import ProjectsList from './ProjectList'
import NewProject from './NewProject'
import SingleProject from './SingleProject'

class App extends Component {
    render() {
        return (
            <BrowserRouter>
                <div>
                    <Header />
                    <Switch>
                        <Route exact path='/' component={ProjectsList} />
                        <Route path='/create' component={NewProject} />
                        <Route path='/show/:id' component={SingleProject} />
                    </Switch>
                </div>
            </BrowserRouter>
        )
    }
}
export default App;

if (document.getElementById('app'))
    ReactDOM.render(<App />, document.getElementById('app'))