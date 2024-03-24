import React from "react";
import ReactDOM from "react-dom/client";
import App from "../components/App.tsx";
import BiblioBar from "../components/BiblioBar.tsx";
import "../styles/index.css";

//  MAIN PAGE
ReactDOM.createRoot(document.getElementById("root")!).render(
  <React.StrictMode>
    <BiblioBar />

    {/* Content */}
    <App />
  </React.StrictMode>
);
