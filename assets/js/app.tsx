import React from "react";
import ReactDOM from "react-dom/client";
import App from "../components/App.tsx";
import Bibliobar from "../components/Bibliobar.tsx";
import "../styles/index.css";

//  MAIN PAGE
ReactDOM.createRoot(document.getElementById("root")!).render(
  <React.StrictMode>
    <div>
      <div>
        <Bibliobar />
      </div>
      {/* Content */}
      <div>
        <App />
      </div>
    </div>
  </React.StrictMode>
);
