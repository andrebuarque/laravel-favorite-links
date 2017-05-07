import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Router, Route, hashHistory, IndexRoute } from 'react-router';

import MenuBar from './components/layout/MenuBar';
import Links from './components/Links';
import Tags from './components/tags/Tags';
import TagsCreate from './components/tags/TagsCreate';
import TagsEdit from './components/tags/TagsEdit';

import './bootstrap';

class App extends Component {
	render() {
		return (
			<div>
				<MenuBar />
				<div className="container">
					{ this.props.children }
				</div>
			</div>
		);
	}
}

ReactDOM.render(
	<Router history={hashHistory}>
    <Route component={App} path="/">
      <IndexRoute component={Links} />
      <Route path="/" component={Links}/>
      <Route path="/tags" component={Tags}/>
      <Route path="/tags/create" component={TagsCreate}/>
      <Route path="/tags/edit/:id" component={TagsEdit}/>
    </Route>
	</Router>,
	document.getElementById('root')
);