import React from "react";

export function ExampleComponent({ title, children }) {
    return (
        <div className="example-component">
            <h3>{title}</h3>
            <div className="example-content">{children}</div>
        </div>
    );
}
