import React from "react";
import { createRoot } from "react-dom/client";
import App from "./App";
import "./styles/main.css";

// Mount React app to any element with id="react-app"
const container = document.getElementById("react-app");
if (container) {
    const root = createRoot(container);
    root.render(
        <React.StrictMode>
            <App />
        </React.StrictMode>
    );
}

// You can also export utilities to use React components elsewhere
export { App };
