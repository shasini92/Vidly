import React from 'react';
import _ from 'lodash';
import PropTypes from 'prop-types';

const Pagination = (props) => {
    const {itemsCount, pageSize, onPageChange, currentPage} = props;

    const pagesCount = itemsCount/pageSize;
    // We don't want to render anything if the pagesCount is 1
    if(pagesCount < 2) return null;
    // Use lodash to generate an array using these numbers, first number is the starting number of the array and the second number is the last number in the array
    const pages = _.range(1, pagesCount+1);

    return (

        <nav aria-label="Page navigation example" >
            <ul className="pagination justify-content-center">
                {pages.map(page =><li key={page} className={page===currentPage ? "page-item active" : "page-item"}><a onClick={()=> onPageChange(page)} className="page-link" >{page}</a></li>)}
            </ul>
        </nav>
    );
};

Pagination.propTypes = {
    itemsCount: PropTypes.number.isRequired,
    pageSize: PropTypes.number.isRequired,
    onPageChange: PropTypes.func.isRequired,
    currentPage: PropTypes.number.isRequired,
};

export default Pagination;
