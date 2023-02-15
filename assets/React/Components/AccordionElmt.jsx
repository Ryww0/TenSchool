import React, {Fragment, Component} from "react";
import CrossSvg from "./CrossSvg";

class AccordionElmt extends Component {
    state = {
        svg: React.createRef(),
        div: React.createRef(),
        etat: true
    }

    openDiv() {
        this.state.div.current.classList.toggle('d-none')
        this.state.div.current.classList.toggle('d-block')
        this.state.svg.current.classList.toggle('svg-active')

        this.setState({
            etat: !this.state.etat
        })
    }

    render() {
        return (
            <>
                <div className="home-accordion-container d-flex flex-column justify-content-center mt-3 mb-3">
                    <div
                        className="home-accordion-title d-flex align-items-center justify-content-between">
                        <h4>{this.props.title}</h4>
                        <div onClick={() => this.openDiv()}>
                            <CrossSvg props={this.state.svg}/>
                        </div>
                    </div>
                    <div ref={this.state.div}
                         className="home-accordion-content d-none mb-5 container ps-5 pe-5">
                        <p>
                            {this.props.content}
                        </p>
                    </div>
                </div>
            </>
        );
    }
}

export default AccordionElmt