import React from 'react';
import ReactDOM from 'react-dom';

const App = ({ prop1, prop2 }) => (
    <div>
      <h1>{prop1} {prop2}!</h1>
    </div>
);

const root = document.getElementById('root');

ReactDOM.render(<App prop1={ prop1 } prop2={ prop2 } />, root);
