import React from "react";
import AccordionElmt from "./AccordionElmt";


class Accordion extends React.Component {

    state = {

        title1: "Qu'est ce que tenschool ?",
        title2: "Que peut-on trouver sur tenschool ?",
        title3: "Qui ajoute les cours sur le site ?",
        content: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor\n" +
            "incididunt ut labore et dolore magna aliqua.\n" +
            "\n" +
            "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore\n" +
            "eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt\n" +
            "in culpa qui officia deserunt mollit anim id est laborum.\n"

    }

    render() {
        return (
            <>
                <AccordionElmt title={this.state.title1} content={this.state.content}/>
                <AccordionElmt title={this.state.title2} content={this.state.content}/>
                <AccordionElmt title={this.state.title3} content={this.state.content}/>
            </>
        )
    }
}

export default Accordion