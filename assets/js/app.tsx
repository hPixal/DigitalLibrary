import React from "react";
import ReactDOM from "react-dom/client";
import App from "../components/App.tsx";
<<<<<<< HEAD
import Bibliobar from "../components/Bibliobar.tsx";
=======
import BiblioBar from "../components/BiblioBar.tsx";
>>>>>>> b56bd0b8ed276b5ae16b688f7229bc5e4348403e
import "../styles/index.css";

//  MAIN PAGE
ReactDOM.createRoot(document.getElementById("root")!).render(
  <React.StrictMode>
<<<<<<< HEAD
    <div>
      <div>Hola crack que onda, aca andamos</div>
      <div>Otro div aca por lasdudas, paso nomas de onda</div>
    </div>
=======
    <BiblioBar />

    {/* Content */}
>>>>>>> b56bd0b8ed276b5ae16b688f7229bc5e4348403e
    <App />
  </React.StrictMode>
);
