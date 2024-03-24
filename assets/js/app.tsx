import React from "react";
import ReactDOM from "react-dom/client";
import App from "../components/App.tsx";
import Bibliobar from "../components/Bibliobar.tsx";
import "../styles/index.css";

ReactDOM.createRoot(document.getElementById("root")!).render(
  <React.StrictMode>
    <div>
      <div>Hola crack que onda, aca andamos</div>
      <div>Otro div aca por lasdudas, paso nomas de onda</div>
    </div>
    <App />
  </React.StrictMode>
);
