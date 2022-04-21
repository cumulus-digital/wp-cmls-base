import "./frontend.scss";

import throttle from "lodash/throttle";

document.querySelector("html").className.replace("no-js", "js");
const setVh = () => {
  const vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty("--vh", `${vh}px`);
};
addEventListener("load", setVh);
addEventListener("resize", throttle(setVh, 100));

addEventListener("load", () => {
  /**
   * when a query block pagination is called for, attempt to
   * scroll the window to the query block.
   */
  let qSearch = location.search.match(/(\??query\-(\d+)\-page)/);
  if (qSearch && !location?.hash?.length) {
    let nav = document.querySelector(`[href*="${qSearch[0]}"]`);
    if (nav) {
      let queryBlock = nav.closest(".wp-block-query");
      if (queryBlock) {
        queryBlock.scrollIntoView({ behavior: "smooth", block: "nearest" });
      }
    }
  }
});

import "./js/frontend/masthead.js";
import "./js/frontend/menu.js";
