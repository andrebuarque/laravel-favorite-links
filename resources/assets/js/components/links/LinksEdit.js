import React, { Component } from 'react';

import PageHeader from '../layout/PageHeader';
import Form from './LinksForm';

class LinksEdit extends Component {
  constructor(props) {
    super(props);
  
    this.state = {
      title: ''
    };

    this.handleInputChange = this.handleInputChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  handleInputChange(event) {
    const target = event.target;

    this.setState({
      [target.name]: target.value
    });
  }

  handleSubmit(event) {
    event.preventDefault();

    alert(`save the link with name: ${this.state.title}`);
  }

	render() {
		return (
			<div>
        <PageHeader title="Editar link" />

        <div style={{ marginTop: '15px' }}>
          <Form handleInputChange={this.handleInputChange} callbackSave={this.handleSubmit} />
        </div>
      </div>
		);
	}
}

export default LinksEdit;