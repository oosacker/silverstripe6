import React, { useState } from "react";

function App() {
    const [count, setCount] = useState(0);

    return (
        <div className="react-app">
            <h2>React Component</h2>
            <p>This is a React component running in your SilverStripe theme.</p>
            <div className="counter">
                <button onClick={() => setCount(count - 1)}>-</button>
                <span>{count}</span>
                <button onClick={() => setCount(count + 1)}>+</button>
            </div>
        </div>
    );
}

export default App;
