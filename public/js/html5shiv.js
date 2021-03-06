INDX( 	                 @   �
  �      ^                                             �    x f     �    �[?��S���P�S���P�S��[?��S�       >              M e m c a c h e d C a c h e . p h p   �    p Z     �    �48��S���P�S���P�S��48��S�       G              M E M C A C ~ 1 . P H P       �    p Z     �    �[?��S���P�S���P�S��[?��S�       >              M E M C A C ~ 2 . P H P       �    x b     �    �F��S�JDP�S�JDP�S��F��S�                    ^ M o n g o D B C a c h e . p h p       �    p Z     �    �F��S�JDP�S�JDP�S��F��S�                      M O N G O D ~ 1 . P H P       �    x d     �    S�M��S�JDP�S�JDP�S�S�M��S�       C              M u l t i G e t C a c h e . p h p     �    p Z     �    S�M��S�JDP�S�JDP�S�S�M��S�       C              M U L T I G ~ 1 . P H P       �    x b     �    \�T��S��
P�S��
P�S�\�T��S�                     P h p F i l e C a c h e . p h p       �   ^ p Z     �    \�T��S��
P�S��
P�S�\�T��S�                     P H P F I L ~ 1 . P H P       �    p `     �    D�Y��S��
P�S��
P�S�D�Y��S�       	              P r e d i s C a c h e . p h p �    p Z     �    D�Y��S��
P�S��
P�S�D�Y��S�       	              P R E D I S ~ 1 . P H P       �    p ^     �    G�e��S��
P�S��
P�S�G�e��S�       �              R e d i s C a c h e . p h p   �    p Z     �    G�e��S��
P�S��
P�S�G�e��S�       �    ^         R E D I S C ~ 1 . P H P       �    p \     �    gGj��S��
P�S��
P�S�gGj��S�        �              R i a k C a c h e . p h p     �    p Z     �    gGj��S��
P�S��
P�S�gGj��S�        �              R I A K C A ~ 1 . P H P       �    x b     �    �1v��S�{k P�S�{k P�S��1v��S�        *              S Q L i t e 3 C a c h e . p h p       �    p Z     �    �1v��S�{k P�S�{k P�S��1v��S�        *              S Q L I T E ~ 1 . P H P       �    h X   ^ �    Y}��S�{k P�S�{k P�S�Y}��S�       .              V e r s i o n . p h p �    p \     �    |ↈ�S�{k P�S�{k P�S�|ↈ�S�       �              V o i d C a c h e . p h p     �    p Z     �    |ↈ�S�{k P�S�{k P�S�|ↈ�S�       �              V O I D C A ~ 1 . P H P       �    x d     �    �����S���"P�S���"P�S������S�       �
              W i n C a c h e C a c h e . p h p     �    p Z     �    �����S���"P�S���"P�S������S�       �
            ^ W I N C A C ~ 1 . P H P       �    p Z     �    �m���S���)P�S���)P�S��m���S�       Y              X C A C H E ~ 1 . P H P                     �    p Z     �    �F��S�JDP�S�JDP�S��F��S�                      M O N G O D ~ 1 . P H P       �    x d     �    S�M��S�JDP�S�JDP�S�S�M��S�       C              M u l t i G e t C a c h e . p h p     �    p Z     �    S�M��S�JDP�S�JDP�S�S�M��S�       C              M U L T I G ~ 1 . P H P       �   ^ x b     �    \�T��S��
P�S��
P�S�\�T��S�                     P h p F i l e C a c h e . p h p       �    p Z     �    \�T��S��
P�S��
P�S�\�T��S�                     P H P F I L ~ 1 . P H P       �    p `     �    D�Y��S��
P�S��
P�S�D�Y��S�       	              P r e d i s C a c h e . p h p �    p Z     �    D�Y��S��
P�S��
P�S�D�Y��S�       	              P R E D I S ~ 1 . P H P       �    p ^     �    G�e��S��
P�S��
P�S�G�e��S�     ^ �              R e d i s C a c h e . p h p   �    p Z     �    G�e��S��
P�S��
P�S�G�e��S�       �              R E D I S C ~ 1 . P H P       �    p \     �    gGj��S��
P�S��
P�S�gGj��S�        �              R i a k C a c h e . p h p     �    p Z     �    gGj��S��
P�S��
P�S�gGj��S�        �              R I A K C A ~ 1 . P H P       �    p Z     �    �1v��S�{k P�S�{k P�S��1v��S�        *              S Q L I T E ~ 1 . P H P                   ^   data = {};
            expanID++;
            ownerDocument[expando] = expanID;
            expandoData[expanID] = data;
        }
        return data;
    }

    /**
     * returns a shived element for the given nodeName and document
     * @memberOf html5
     * @param {String} nodeName name of the element
     * @param {Document} ownerDocument The context document.
     * @returns {Object} The shived element.
     */
    function createElement(nodeName, ownerDocument, data){
        if (!ownerDocument) {
            ownerDocument = document;
        }
        if(supportsUnknownElements){
            return ownerDocument.createElement(nodeName);
        }
        if (!data) {
            data = getExpandoData(ownerDocument);
        }
        var node;

        if (data.cache[nodeName]) {
            node = data.cache[nodeName].cloneNode();
        } else if (saveClones.test(nodeName)) {
            node = (data.cache[nodeName] = data.createElem(nodeName)).cloneNode();
        } else {
            node = data.createElem(nodeName);
        }

        // Avoid adding some elements to fragments in IE < 9 because
        // * Attributes like `name` or `type` cannot be set/changed once an element
        //   is inserted into a document/fragment
        // * Link elements with `src` attributes that are inaccessible, as with
        //   a 403 response, will cause the tab/window to crash
        // * Script elements appended to fragments will execute when their `src`
        //   or `text` property is set
        return node.canHaveChildren && !reSkip.test(nodeName) && !node.tagUrn ? data.frag.appendChild(node) : node;
    }

    /**
     * returns a shived DocumentFragment for the given document
     * @memberOf html5
     * @param {Document} ownerDocument The context document.
     * @returns {Object} The shived DocumentFragment.
     */
    function createDocumentFragment(ownerDocument, data){
        if (!ownerDocument) {
            ownerDocument = document;
        }
        if(supportsUnknownElements){
            return ownerDocument.createDocumentFragment();
        }
        data = data || getExpandoData(ownerDocument);
        var clone = data.frag.cloneNode(),
            i = 0,
            elems = getElements(),
            l = elems.length;
        for(;i<l;i++){
            clone.createElement(elems[i]);
        }
        return clone;
    }

    /**
     * Shivs the `createElement` and `createDocumentFragment` methods of the document.
     * @private
     * @param {Document|DocumentFragment} ownerDocument The document.
     * @param {Object} data of the document.
     */
    function shivMethods(ownerDocument, data) {
        if (!data.cache) {
            data.cache = {};
            data.createElem = ownerDocument.createElement;
            data.createFrag = ownerDocument.createDocumentFragment;
            data.frag = data.createFrag();
        }


        ownerDocument.createElement = function(nodeName) {
            //abort shiv
            if (!html5.shivMethods) {
                return data.createElem(nodeName);
            }
            return createElement(nodeName, ownerDocument, data);
        };

        ownerDocument.createDocumentFragment = Function('h,f', 'return function(){' +
            'var n=f.cloneNode(),c=n.createElement;' +
            'h.shivMethods&&(' +
            // unroll the `createElement` calls
            getElements().join().replace(/[\w\-:]+/g, function(nodeName) {
                data.createElem(nodeName);
                data.frag.createElement(nodeName);
                return 'c("' + nodeName + '")';
            }) +
            ');return n}'
        )(html5, data.frag);
    }

    /*--------------------------------------------------------------------------*/

    /**
     * Shivs the given document.
     * @memberOf html5
     * @param {Document} ownerDocument The document to shiv.
     * @returns {Document} The shived document.
     */
    function shivDocument(ownerDocument) {
        if (!ownerDocument) {
            ownerDocument = document;
        }
        var data = getExpandoData(ownerDocument);

        if (html5.shivCSS && !supportsHtml5Styles && !data.hasCSS) {
            data.hasCSS = !!addStyleSheet(ownerDocument,
                // corrects block display not defined in IE6/7/8/9
                'article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}' +
                    // adds styling not present in IE6/7/8/9
                    'mark{background:#FF0;color:#000}' +
                    // hides non-rendered elements
                    'template{display:none}'
            );
        }
        if (!supportsUnknownElements) {
            shivMethods(ownerDocument, data);
        }
        return ownerDocument;
    }

    /*--------------------------------------------------------------------------*/

    /**
     * The `html5` object is exposed so that more elements can be shived and
     * existing shiving can be detected on iframes.
     * @type Object
     * @example
     *
     * // options can be changed before the script is included
     * html5 = { 'elements': 'mark section', 'shivCSS': false, 'shivMethods': false };
     */
    var html5 = {

        /**
         * An array or space separated string of node names of the elements to shiv.
         * @memberOf html5
         * @type Array|String
         */
        'elements': options.elements || 'abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output picture progress section summary template time video',

        /**
         * current version of html5shiv
         */
        'version': version,

        /**
         * A flag to indicate that the HTML5 style sheet should be inserted.
         * @memberOf html5
         * @type Boolean
         */
        'shivCSS': (options.shivCSS !== false),

        /**
         * Is equal to true if a browser supports creating unknown/HTML5 elements
         * @memberOf html5
         * @type boolean
         */
        'supportsUnknownElements': supportsUnknownElements,

        /**
         * A flag to indicate that the document's `createElement` and `createDocumentFragment`
         * methods should be overwritten.
         * @memberOf html5
         * @type Boolean
         */
        'shivMethods': (options.shivMethods !== false),

        /**
         * A string to describe the type of `html5` object ("default" or "default print").
         * @memberOf html5
         * @type String
         */
        'type': 'default',

        // shivs the document according to the specified `html5` object options
        'shivDocument': shivDocument,

        //creates a shived element
        createElement: createElement,

        //creates a shived documentFragment
        createDocumentFragment: createDocumentFragment,

        //extends list of elements
        addElements: addElements
    };

    /*--------------------------------------------------------------------------*/

    // expose html5
    window.html5 = html5;

    // shiv the document
    shivDocument(document);

}(this, document));
