# website_3

include() will throw a warning if it can't include the file, but the rest of the script will run.

require() will throw an E_COMPILE_ERROR and halt the script if it can't include the file.

The include_once() and require_once() functions will not include the file a second time if it has already been included.


