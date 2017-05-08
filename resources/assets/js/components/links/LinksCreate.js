import React, {Component} from 'react';

import PageHeader from '../layout/PageHeader';
import Form from './LinksForm';

class LinksCreate extends Component {
  constructor(props) {
    super(props);

    this.state = {
      title: '',
      url: '',
      tags: []
    };

    this.handleInputChange = this.handleInputChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  handleInputChange(event) {
    if (('length' in event)) {
      this.setState({
        tags: event
      });

      return;
    }

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
        <PageHeader title="Novo link"/>

        <div style={{marginTop: '15px'}}>
          <Form handleInputChange={this.handleInputChange} callbackSave={this.handleSubmit}/>
        </div>
      </div>
    );
  }
}

export default LinksCreate;