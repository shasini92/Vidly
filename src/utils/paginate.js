import _ from "lodash";

export function paginate(items, pageNumber, pageSize) {
  const startIndex = (pageNumber - 1) * pageSize;
  // To use multiple actions at once we use a lodash wrapper (), and finally use value to convert to an actual array
  return _(items)
    .slice(startIndex)
    .take(pageSize)
    .value();
}
