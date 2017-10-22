import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Example extends Component {
    constructor(props) {
    super(props);
  }
    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-8 col-md-offset-2">
                        <div className="panel panel-default">
                            <div className="panel-heading">Example Component</div>

                            <div className="panel-body">
                                {props.name}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
function Welcome(props) {
  return <h1>Hello, {props.name}</h1>;
}
if (document.getElementById('example')) {
    ReactDOM.render(<Welcome name = {urlfloor} />, document.getElementById('example'));
}
