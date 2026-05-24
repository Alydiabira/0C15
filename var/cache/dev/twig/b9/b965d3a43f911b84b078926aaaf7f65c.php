<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* @WebProfiler/Collector/time.js */
class __TwigTemplate_995078d4d3dc8e09918a14bbf546f38b extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/time.js"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/time.js"));

        // line 1
        yield "\x27use strict\x27;

class TimelineEngine {
    /**
     * @param  {Theme} theme
     * @param  {Renderer} renderer
     * @param  {Legend} legend
     * @param  {Element} threshold
     * @param  {Object} request
     * @param  {Number} eventHeight
     * @param  {Number} horizontalMargin
     */
    constructor(theme, renderer, legend, threshold, request, eventHeight = 36, horizontalMargin = 10) {
        this.theme = theme;
        this.renderer = renderer;
        this.legend = legend;
        this.threshold = threshold;
        this.request = request;
        this.scale = renderer.width / request.end;
        this.eventHeight = eventHeight;
        this.horizontalMargin = horizontalMargin;
        this.labelY = Math.round(this.eventHeight * 0.48);
        this.periodY = Math.round(this.eventHeight * 0.66);
        this.FqcnMatcher = /\\\\([^\\\\]+)\$/i;
        this.origin = null;

        this.createEventElements = this.createEventElements.bind(this);
        this.createBackground = this.createBackground.bind(this);
        this.createPeriod = this.createPeriod.bind(this);
        this.render = this.render.bind(this);
        this.renderEvent = this.renderEvent.bind(this);
        this.renderPeriod = this.renderPeriod.bind(this);
        this.onResize = this.onResize.bind(this);
        this.isActive = this.isActive.bind(this);

        this.threshold.addEventListener(\x27change\x27, this.render);
        this.legend.addEventListener(\x27change\x27, this.render);

        window.addEventListener(\x27resize\x27, this.onResize);

        this.createElements();
        this.render();
    }

    onResize() {
        this.renderer.measure();
        this.setScale(this.renderer.width / this.request.end);
    }

    setScale(scale) {
        if (scale !== this.scale) {
            this.scale = scale;
            this.render();
        }
    }

    createElements() {
        this.origin = this.renderer.setFullVerticalLine(this.createBorder(), 0);
        this.renderer.add(this.origin);

        this.request.events
            .filter(event => event.category === \x27section\x27)
            .map(this.createBackground)
            .forEach(this.renderer.add);

        this.request.events
            .map(this.createEventElements)
            .forEach(this.renderer.add);
    }

    createBackground(event) {
        const subrequest = event.name === \x27__section__.child\x27;
        const background = this.renderer.create(\x27rect\x27, subrequest ? \x27timeline-subrequest\x27 : \x27timeline-border\x27);

        event.elements = Object.assign(event.elements || {}, { background });

        return background;
    }

    createEventElements(event) {
        const { name, category, duration, memory, periods } = event;
        const border = this.renderer.setFullHorizontalLine(this.createBorder(), 0);
        const lines = periods.map(period => this.createPeriod(period, category));
        const label = this.createLabel(this.getShortName(name), duration, memory, periods[0]);
        const title = this.renderer.createTitle(name);
        const group = this.renderer.group([title, border, label].concat(lines), this.theme.getCategoryColor(event.category));

        event.elements = Object.assign(event.elements || {}, { group, label, border });

        this.legend.add(event.category)

        return group;
    }

    createLabel(name, duration, memory, period) {
        const label = this.renderer.createText(name, period.start * this.scale, this.labelY, \x27timeline-label\x27);
        const sublabel = this.renderer.createTspan(`  \${duration} ms / \${memory} MiB`, \x27timeline-sublabel\x27);

        label.appendChild(sublabel);

        return label;
    }

    createPeriod(period, category) {
        const timeline = this.renderer.createPath(null, \x27timeline-period\x27, this.theme.getCategoryColor(category));

        period.draw = category === \x27section\x27 ? this.renderer.setSectionLine : this.renderer.setPeriodLine;
        period.elements = Object.assign(period.elements || {}, { timeline });

        return timeline;
    }

    createBorder() {
        return this.renderer.createPath(null, \x27timeline-border\x27);
    }

    isActive(event) {
        const { duration, category } = event;

        return duration >= this.threshold.value && this.legend.isActive(category);
    }

    render() {
        const events = this.request.events.filter(this.isActive);
        const width = this.renderer.width + this.horizontalMargin * 2;
        const height = this.eventHeight * events.length;

        // Set view box
        this.renderer.setViewBox(-this.horizontalMargin, 0, width, height);

        // Show 0ms origin
        this.renderer.setFullVerticalLine(this.origin, 0);

        // Render all events
        this.request.events.forEach(event => this.renderEvent(event, events.indexOf(event)));
    }

    renderEvent(event, index) {
        const { name, category, duration, memory, periods, elements } = event;
        const { group, label, border, background } = elements;
        const visible = index >= 0;

        group.setAttribute(\x27visibility\x27, visible ? \x27visible\x27 : \x27hidden\x27);

        if (background) {
            background.setAttribute(\x27visibility\x27, visible ? \x27visible\x27 : \x27hidden\x27);

            if (visible) {
                const [min, max] = this.getEventLimits(event);

                this.renderer.setFullRectangle(background, min * this.scale, max * this.scale);
            }
        }

        if (visible) {
            // Position the group
            group.setAttribute(\x27transform\x27, `translate(0, \${index * this.eventHeight})`);

            // Update top border
            this.renderer.setFullHorizontalLine(border, 0);

            // render label and ensure it doesn\x27t escape the viewport
            this.renderLabel(label, event);

            // Update periods
            periods.forEach(this.renderPeriod);
        }
    }

    renderLabel(label, event) {
        const width = this.getLabelWidth(label);
        const [min, max] = this.getEventLimits(event);
        const alignLeft = (min * this.scale) + width <= this.renderer.width;

        label.setAttribute(\x27x\x27, (alignLeft ? min : max) * this.scale);
        label.setAttribute(\x27text-anchor\x27, alignLeft ? \x27start\x27 : \x27end\x27);
    }

    renderPeriod(period) {
        const { elements, start, duration } = period;

        period.draw(elements.timeline, start * this.scale, this.periodY, Math.max(duration * this.scale, 1));
    }

    getLabelWidth(label) {
        if (typeof label.width === \x27undefined\x27) {
            label.width = label.getBBox().width;
        }

        return label.width;
    }

    getEventLimits(event) {
        if (typeof event.limits === \x27undefined\x27) {
            const { periods } = event;

            event.limits = [
                periods[0].start,
                periods[periods.length - 1].end
            ];
        }

        return event.limits;
    }

    getShortName(name) {
        const matches = this.FqcnMatcher.exec(name);

        if (matches) {
            return matches[1];
        }

        return name;
    }
}

class Legend {
    constructor(element, theme) {
        this.element = element;
        this.theme = theme;

        this.toggle = this.toggle.bind(this);
        this.createCategory = this.createCategory.bind(this);

        this.categories = [];
        this.theme.getDefaultCategories().forEach(this.createCategory);
    }

    add(category) {
        this.get(category).classList.add(\x27present\x27);
    }

    createCategory(category) {
        const element = document.createElement(\x27button\x27);
        element.className = `timeline-category active`;
        element.style.borderColor = this.theme.getCategoryColor(category);
        element.innerText = category;
        element.value = category;
        element.type = \x27button\x27;
        element.addEventListener(\x27click\x27, this.toggle);

        this.element.appendChild(element);

        this.categories.push(element);

        return element;
    }

    toggle(event) {
        event.target.classList.toggle(\x27active\x27);

        this.emit(\x27change\x27);
    }

    isActive(category) {
        return this.get(category).classList.contains(\x27active\x27);
    }

    get(category) {
        return this.categories.find(element => element.value === category) || this.createCategory(category);
    }

    emit(name) {
        this.element.dispatchEvent(new Event(name));
    }

    addEventListener(name, callback) {
        this.element.addEventListener(name, callback);
    }

    removeEventListener(name, callback) {
        this.element.removeEventListener(name, callback);
    }
}

class SvgRenderer {
    /**
     * @param  {SVGElement} element
     */
    constructor(element) {
        this.ns = \x27http://www.w3.org/2000/svg\x27;
        this.width = null;
        this.viewBox = {};
        this.element = element;

        this.add = this.add.bind(this);

        this.setViewBox(0, 0, 0, 0);
        this.measure();
    }

    setViewBox(x, y, width, height) {
        this.viewBox = { x, y, width, height };
        this.element.setAttribute(\x27viewBox\x27, `\${x} \${y} \${width} \${height}`);
    }

    measure() {
        this.width = this.element.getBoundingClientRect().width;
    }

    add(element) {
        this.element.appendChild(element);
    }

    group(elements, className) {
        const group = this.create(\x27g\x27, className);

        elements.forEach(element => group.appendChild(element));

        return group;
    }

    setHorizontalLine(element, x, y, width) {
        element.setAttribute(\x27d\x27, `M\${x},\${y} h\${width}`);

        return element;
    }

    setVerticalLine(element, x, y, height) {
        element.setAttribute(\x27d\x27, `M\${x},\${y} v\${height}`);

        return element;
    }

    setFullHorizontalLine(element, y) {
        return this.setHorizontalLine(element, this.viewBox.x, y, this.viewBox.width);
    }

    setFullVerticalLine(element, x) {
        return this.setVerticalLine(element, x, this.viewBox.y, this.viewBox.height);
    }

    setFullRectangle(element, min, max) {
        element.setAttribute(\x27x\x27, min);
        element.setAttribute(\x27y\x27, this.viewBox.y);
        element.setAttribute(\x27width\x27, max - min);
        element.setAttribute(\x27height\x27, this.viewBox.height);
    }

    setSectionLine(element, x, y, width, height = 4, markerSize = 6) {
        const totalHeight = height + markerSize;
        const maxMarkerWidth = Math.min(markerSize, width / 2);
        const widthWithoutMarker = Math.max(0, width - (maxMarkerWidth * 2));

        element.setAttribute(\x27d\x27, `M\${x},\${y + totalHeight} v\${-totalHeight} h\${width} v\${totalHeight} l\${-maxMarkerWidth} \${-markerSize} h\${-widthWithoutMarker} Z`);
    }

    setPeriodLine(element, x, y, width, height = 4, markerWidth = 2, markerHeight = 4) {
        const totalHeight = height + markerHeight;
        const maxMarkerWidth = Math.min(markerWidth, width);

        element.setAttribute(\x27d\x27, `M\${x + maxMarkerWidth},\${y + totalHeight} h\${-maxMarkerWidth} v\${-totalHeight} h\${width} v\${height} h\${maxMarkerWidth-width}Z`);
    }

    createText(content, x, y, className) {
        const element = this.create(\x27text\x27, className);

        element.setAttribute(\x27x\x27, x);
        element.setAttribute(\x27y\x27, y);
        element.textContent = content;

        return element;
    }

    createTspan(content, className) {
        const element = this.create(\x27tspan\x27, className);

        element.textContent = content;

        return element;
    }

    createTitle(content) {
        const element = this.create(\x27title\x27);

        element.textContent = content;

        return element;
    }

    createPath(path = null, className = null, color = null) {
        const element = this.create(\x27path\x27, className);

        if (path) {
            element.setAttribute(\x27d\x27, path);
        }

        if (color) {
            element.setAttribute(\x27fill\x27, color);
        }

        return element;
    }

    create(name, className = null) {
        const element = document.createElementNS(this.ns, name);

        if (className) {
            element.setAttribute(\x27class\x27, className);
        }

        return element;
    }
}

class Theme {
    constructor(element) {
        this.reservedCategoryColors = {
            \x27default\x27: \x27#737373\x27,
            \x27section\x27: \x27#a3a3a3\x27,
            \x27event_listener\x27: \x27#54aeff\x27,
            \x27template\x27: \x27#4ac26b\x27,
            \x27doctrine\x27: \x27#fd8c73\x27,
            \x27messenger_middleware\x27: \x27#ff8182\x27,
            \x27controller.argument_value_resolver\x27: \x27#c297ff\x27,
            \x27http_client\x27: \x27#d4a72c\x27,
        };

        this.customCategoryColors = [
            \x27#d4a72c\x27, // dark yellow
            \x27#ffaba8\x27, // light red
            \x27#e6af05\x27, // yellow
            \x27#6fdd8b\x27, // light green
            \x27#76e3ea\x27, // cyan
            \x27#a475f9\x27, // light purple
        ];

        this.getCategoryColor = this.getCategoryColor.bind(this);
        this.getDefaultCategories = this.getDefaultCategories.bind(this);
    }

    getDefaultCategories() {
        return Object.keys(this.reservedCategoryColors);
    }

    getCategoryColor(category) {
        return this.reservedCategoryColors[category] || this.getRandomColor(category);
    }

    getRandomColor(category) {
        // instead of pure randomness, colors are assigned deterministically based on the
        // category name, to ensure that each custom category always displays the same color
        return this.customCategoryColors[this.hash(category) % this.customCategoryColors.length];
    }

    // copied from https://github.com/darkskyapp/string-hash
    hash(string) {
        var hash = 5381;
        var i = string.length;

        while(i) {
            hash = (hash * 33) ^ string.charCodeAt(--i);
        }

        return hash >>> 0;
    }
}
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@WebProfiler/Collector/time.js";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("\x27use strict\x27;

class TimelineEngine {
    /**
     * @param  {Theme} theme
     * @param  {Renderer} renderer
     * @param  {Legend} legend
     * @param  {Element} threshold
     * @param  {Object} request
     * @param  {Number} eventHeight
     * @param  {Number} horizontalMargin
     */
    constructor(theme, renderer, legend, threshold, request, eventHeight = 36, horizontalMargin = 10) {
        this.theme = theme;
        this.renderer = renderer;
        this.legend = legend;
        this.threshold = threshold;
        this.request = request;
        this.scale = renderer.width / request.end;
        this.eventHeight = eventHeight;
        this.horizontalMargin = horizontalMargin;
        this.labelY = Math.round(this.eventHeight * 0.48);
        this.periodY = Math.round(this.eventHeight * 0.66);
        this.FqcnMatcher = /\\\\([^\\\\]+)\$/i;
        this.origin = null;

        this.createEventElements = this.createEventElements.bind(this);
        this.createBackground = this.createBackground.bind(this);
        this.createPeriod = this.createPeriod.bind(this);
        this.render = this.render.bind(this);
        this.renderEvent = this.renderEvent.bind(this);
        this.renderPeriod = this.renderPeriod.bind(this);
        this.onResize = this.onResize.bind(this);
        this.isActive = this.isActive.bind(this);

        this.threshold.addEventListener(\x27change\x27, this.render);
        this.legend.addEventListener(\x27change\x27, this.render);

        window.addEventListener(\x27resize\x27, this.onResize);

        this.createElements();
        this.render();
    }

    onResize() {
        this.renderer.measure();
        this.setScale(this.renderer.width / this.request.end);
    }

    setScale(scale) {
        if (scale !== this.scale) {
            this.scale = scale;
            this.render();
        }
    }

    createElements() {
        this.origin = this.renderer.setFullVerticalLine(this.createBorder(), 0);
        this.renderer.add(this.origin);

        this.request.events
            .filter(event => event.category === \x27section\x27)
            .map(this.createBackground)
            .forEach(this.renderer.add);

        this.request.events
            .map(this.createEventElements)
            .forEach(this.renderer.add);
    }

    createBackground(event) {
        const subrequest = event.name === \x27__section__.child\x27;
        const background = this.renderer.create(\x27rect\x27, subrequest ? \x27timeline-subrequest\x27 : \x27timeline-border\x27);

        event.elements = Object.assign(event.elements || {}, { background });

        return background;
    }

    createEventElements(event) {
        const { name, category, duration, memory, periods } = event;
        const border = this.renderer.setFullHorizontalLine(this.createBorder(), 0);
        const lines = periods.map(period => this.createPeriod(period, category));
        const label = this.createLabel(this.getShortName(name), duration, memory, periods[0]);
        const title = this.renderer.createTitle(name);
        const group = this.renderer.group([title, border, label].concat(lines), this.theme.getCategoryColor(event.category));

        event.elements = Object.assign(event.elements || {}, { group, label, border });

        this.legend.add(event.category)

        return group;
    }

    createLabel(name, duration, memory, period) {
        const label = this.renderer.createText(name, period.start * this.scale, this.labelY, \x27timeline-label\x27);
        const sublabel = this.renderer.createTspan(`  \${duration} ms / \${memory} MiB`, \x27timeline-sublabel\x27);

        label.appendChild(sublabel);

        return label;
    }

    createPeriod(period, category) {
        const timeline = this.renderer.createPath(null, \x27timeline-period\x27, this.theme.getCategoryColor(category));

        period.draw = category === \x27section\x27 ? this.renderer.setSectionLine : this.renderer.setPeriodLine;
        period.elements = Object.assign(period.elements || {}, { timeline });

        return timeline;
    }

    createBorder() {
        return this.renderer.createPath(null, \x27timeline-border\x27);
    }

    isActive(event) {
        const { duration, category } = event;

        return duration >= this.threshold.value && this.legend.isActive(category);
    }

    render() {
        const events = this.request.events.filter(this.isActive);
        const width = this.renderer.width + this.horizontalMargin * 2;
        const height = this.eventHeight * events.length;

        // Set view box
        this.renderer.setViewBox(-this.horizontalMargin, 0, width, height);

        // Show 0ms origin
        this.renderer.setFullVerticalLine(this.origin, 0);

        // Render all events
        this.request.events.forEach(event => this.renderEvent(event, events.indexOf(event)));
    }

    renderEvent(event, index) {
        const { name, category, duration, memory, periods, elements } = event;
        const { group, label, border, background } = elements;
        const visible = index >= 0;

        group.setAttribute(\x27visibility\x27, visible ? \x27visible\x27 : \x27hidden\x27);

        if (background) {
            background.setAttribute(\x27visibility\x27, visible ? \x27visible\x27 : \x27hidden\x27);

            if (visible) {
                const [min, max] = this.getEventLimits(event);

                this.renderer.setFullRectangle(background, min * this.scale, max * this.scale);
            }
        }

        if (visible) {
            // Position the group
            group.setAttribute(\x27transform\x27, `translate(0, \${index * this.eventHeight})`);

            // Update top border
            this.renderer.setFullHorizontalLine(border, 0);

            // render label and ensure it doesn\x27t escape the viewport
            this.renderLabel(label, event);

            // Update periods
            periods.forEach(this.renderPeriod);
        }
    }

    renderLabel(label, event) {
        const width = this.getLabelWidth(label);
        const [min, max] = this.getEventLimits(event);
        const alignLeft = (min * this.scale) + width <= this.renderer.width;

        label.setAttribute(\x27x\x27, (alignLeft ? min : max) * this.scale);
        label.setAttribute(\x27text-anchor\x27, alignLeft ? \x27start\x27 : \x27end\x27);
    }

    renderPeriod(period) {
        const { elements, start, duration } = period;

        period.draw(elements.timeline, start * this.scale, this.periodY, Math.max(duration * this.scale, 1));
    }

    getLabelWidth(label) {
        if (typeof label.width === \x27undefined\x27) {
            label.width = label.getBBox().width;
        }

        return label.width;
    }

    getEventLimits(event) {
        if (typeof event.limits === \x27undefined\x27) {
            const { periods } = event;

            event.limits = [
                periods[0].start,
                periods[periods.length - 1].end
            ];
        }

        return event.limits;
    }

    getShortName(name) {
        const matches = this.FqcnMatcher.exec(name);

        if (matches) {
            return matches[1];
        }

        return name;
    }
}

class Legend {
    constructor(element, theme) {
        this.element = element;
        this.theme = theme;

        this.toggle = this.toggle.bind(this);
        this.createCategory = this.createCategory.bind(this);

        this.categories = [];
        this.theme.getDefaultCategories().forEach(this.createCategory);
    }

    add(category) {
        this.get(category).classList.add(\x27present\x27);
    }

    createCategory(category) {
        const element = document.createElement(\x27button\x27);
        element.className = `timeline-category active`;
        element.style.borderColor = this.theme.getCategoryColor(category);
        element.innerText = category;
        element.value = category;
        element.type = \x27button\x27;
        element.addEventListener(\x27click\x27, this.toggle);

        this.element.appendChild(element);

        this.categories.push(element);

        return element;
    }

    toggle(event) {
        event.target.classList.toggle(\x27active\x27);

        this.emit(\x27change\x27);
    }

    isActive(category) {
        return this.get(category).classList.contains(\x27active\x27);
    }

    get(category) {
        return this.categories.find(element => element.value === category) || this.createCategory(category);
    }

    emit(name) {
        this.element.dispatchEvent(new Event(name));
    }

    addEventListener(name, callback) {
        this.element.addEventListener(name, callback);
    }

    removeEventListener(name, callback) {
        this.element.removeEventListener(name, callback);
    }
}

class SvgRenderer {
    /**
     * @param  {SVGElement} element
     */
    constructor(element) {
        this.ns = \x27http://www.w3.org/2000/svg\x27;
        this.width = null;
        this.viewBox = {};
        this.element = element;

        this.add = this.add.bind(this);

        this.setViewBox(0, 0, 0, 0);
        this.measure();
    }

    setViewBox(x, y, width, height) {
        this.viewBox = { x, y, width, height };
        this.element.setAttribute(\x27viewBox\x27, `\${x} \${y} \${width} \${height}`);
    }

    measure() {
        this.width = this.element.getBoundingClientRect().width;
    }

    add(element) {
        this.element.appendChild(element);
    }

    group(elements, className) {
        const group = this.create(\x27g\x27, className);

        elements.forEach(element => group.appendChild(element));

        return group;
    }

    setHorizontalLine(element, x, y, width) {
        element.setAttribute(\x27d\x27, `M\${x},\${y} h\${width}`);

        return element;
    }

    setVerticalLine(element, x, y, height) {
        element.setAttribute(\x27d\x27, `M\${x},\${y} v\${height}`);

        return element;
    }

    setFullHorizontalLine(element, y) {
        return this.setHorizontalLine(element, this.viewBox.x, y, this.viewBox.width);
    }

    setFullVerticalLine(element, x) {
        return this.setVerticalLine(element, x, this.viewBox.y, this.viewBox.height);
    }

    setFullRectangle(element, min, max) {
        element.setAttribute(\x27x\x27, min);
        element.setAttribute(\x27y\x27, this.viewBox.y);
        element.setAttribute(\x27width\x27, max - min);
        element.setAttribute(\x27height\x27, this.viewBox.height);
    }

    setSectionLine(element, x, y, width, height = 4, markerSize = 6) {
        const totalHeight = height + markerSize;
        const maxMarkerWidth = Math.min(markerSize, width / 2);
        const widthWithoutMarker = Math.max(0, width - (maxMarkerWidth * 2));

        element.setAttribute(\x27d\x27, `M\${x},\${y + totalHeight} v\${-totalHeight} h\${width} v\${totalHeight} l\${-maxMarkerWidth} \${-markerSize} h\${-widthWithoutMarker} Z`);
    }

    setPeriodLine(element, x, y, width, height = 4, markerWidth = 2, markerHeight = 4) {
        const totalHeight = height + markerHeight;
        const maxMarkerWidth = Math.min(markerWidth, width);

        element.setAttribute(\x27d\x27, `M\${x + maxMarkerWidth},\${y + totalHeight} h\${-maxMarkerWidth} v\${-totalHeight} h\${width} v\${height} h\${maxMarkerWidth-width}Z`);
    }

    createText(content, x, y, className) {
        const element = this.create(\x27text\x27, className);

        element.setAttribute(\x27x\x27, x);
        element.setAttribute(\x27y\x27, y);
        element.textContent = content;

        return element;
    }

    createTspan(content, className) {
        const element = this.create(\x27tspan\x27, className);

        element.textContent = content;

        return element;
    }

    createTitle(content) {
        const element = this.create(\x27title\x27);

        element.textContent = content;

        return element;
    }

    createPath(path = null, className = null, color = null) {
        const element = this.create(\x27path\x27, className);

        if (path) {
            element.setAttribute(\x27d\x27, path);
        }

        if (color) {
            element.setAttribute(\x27fill\x27, color);
        }

        return element;
    }

    create(name, className = null) {
        const element = document.createElementNS(this.ns, name);

        if (className) {
            element.setAttribute(\x27class\x27, className);
        }

        return element;
    }
}

class Theme {
    constructor(element) {
        this.reservedCategoryColors = {
            \x27default\x27: \x27#737373\x27,
            \x27section\x27: \x27#a3a3a3\x27,
            \x27event_listener\x27: \x27#54aeff\x27,
            \x27template\x27: \x27#4ac26b\x27,
            \x27doctrine\x27: \x27#fd8c73\x27,
            \x27messenger_middleware\x27: \x27#ff8182\x27,
            \x27controller.argument_value_resolver\x27: \x27#c297ff\x27,
            \x27http_client\x27: \x27#d4a72c\x27,
        };

        this.customCategoryColors = [
            \x27#d4a72c\x27, // dark yellow
            \x27#ffaba8\x27, // light red
            \x27#e6af05\x27, // yellow
            \x27#6fdd8b\x27, // light green
            \x27#76e3ea\x27, // cyan
            \x27#a475f9\x27, // light purple
        ];

        this.getCategoryColor = this.getCategoryColor.bind(this);
        this.getDefaultCategories = this.getDefaultCategories.bind(this);
    }

    getDefaultCategories() {
        return Object.keys(this.reservedCategoryColors);
    }

    getCategoryColor(category) {
        return this.reservedCategoryColors[category] || this.getRandomColor(category);
    }

    getRandomColor(category) {
        // instead of pure randomness, colors are assigned deterministically based on the
        // category name, to ensure that each custom category always displays the same color
        return this.customCategoryColors[this.hash(category) % this.customCategoryColors.length];
    }

    // copied from https://github.com/darkskyapp/string-hash
    hash(string) {
        var hash = 5381;
        var i = string.length;

        while(i) {
            hash = (hash * 33) ^ string.charCodeAt(--i);
        }

        return hash >>> 0;
    }
}
", "@WebProfiler/Collector/time.js", "/Users/diabiraaly/Desktop/Bureau - MacBook Air de DIABIRA/Openclassrooms/0C15/vendor/symfony/web-profiler-bundle/Resources/views/Collector/time.js");
    }
}
