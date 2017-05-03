import React, { Component } from 'react';
import { Link } from 'react-router';

class PageHeader extends Component {
	render() {
		return (
      <div className="page-header" style={{ margin: '0', borderBottom: '1px solid #cccccc' }}>
        <h1>{ this.props.title }</h1>
      </div>  
		);
	}
}

export default PageHeader;