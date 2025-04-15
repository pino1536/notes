# GitHub Markdown cheat sheet

Nearly any Markdown GitHub support.

## Head
```
# 1th level heading
## 2th level heading
### 3th level heading
```

## Text Style

| Syntax | Output |
| - | - |
| `**Bold**` | **Bold** |
| `*Italic*` | *Italic* |
| `~~Strikethrough~~` | ~~Strikethrough~~ |
| `<ins>Underline</ins>` | <ins>Underline</ins> |
| `<sup>Superscript</sup>` | X<sup>Superscript</sup> |
| `<sub>Subscript</sub>` | X<sub>Subscript</sub> |

## Quote

`> Text`
> Text

## Code

````markdown
`code inline`

```markdown
multi line
with code
language highlighting
```
````

## Color

| Syntax | Output |
| - | - |
| <code>\`#0969DA\`</code> | `#0969DA` |
| <code>\`rgb(9, 105, 218)\`</code> | `rgb(9, 105, 218)` |
| <code>\`hsl(212, 92%, 45%)\`</code> | `hsl(212, 92%, 45%)` |

## Link

| Syntax | Output |
| - | - |
| `[Extern Link](https://github.com/)` | [Extern Link](https://github.com/) |
| `[Link to repository file](../README.md)` | [Link to repository file](../README.md) |
| `[Link to section](#text-styling)` | [Link to section](#text-styling) |

## Line break

```markdown
first line  (2 spaces at the end)
second line
```
first line  
second line

## Image

### normal
`![Alt Text](https://myoctocat.com/assets/images/base-octocat.svg)`

### for different color schemes
```markdown
<picture>
   <source media="(prefers-color-scheme: dark)" srcset="https://myoctocat.com/assets/images/base-octocat.svg">
   <source media="(prefers-color-scheme: light)" srcset="https://myoctocat.com/assets/images/base-octocat.svg">
   <img alt="Alt Text" src="https://myoctocat.com/assets/images/base-octocat.svg">
</picture>
```
![Alt Text](https://user-images.githubusercontent.com/25423296/163456779-a8556205-d0a5-45e2-ac17-42d089e3c3f8.png)


## List

```markdown
- item
- item

1. item
2. item

- item
  - First nested list item
    - Second nested list item
```
- item
- item

1. item
2. item

- item
  - sub item
    - sub sub item


## Task

```markdown
- [x] tasks
- [ ] #739
- [ ] https://github.com/octo-org/octo-repo/issues/740
```
- [x] tasks
- [ ] #739
- [ ] https://github.com/octo-org/octo-repo/issues/740

## Mention

`@pino1536 hello`

@pino1536 hello

## Footnote

```markdown
footnote[^1]
[^1]: reference
```
footnote[^1]

[^1]: reference

## Alert

```markdown
> [!NOTE]
> Note.

> [!TIP]
> Tip..

> [!IMPORTANT]
> Important.

> [!WARNING]
> Warning.

> [!CAUTION]
> Caution.
```
> [!NOTE]
> Note.

> [!TIP]
> Tip..

> [!IMPORTANT]
> Important.

> [!WARNING]
> Warning.

> [!CAUTION]
> Caution.


## Comment

`<!-- markdown comment -->`

<!-- markdown comment -->

## Ignor formating

`\*ignore bold\*`

\*ignore bold\*

## Table

```markdown
| collum 1 | collum 2 | collum 3 |
| - | :-: | -: |
| item | item | item |
| item | item | item |
```
```markdown
-:    =   right aligned
:-:   =   center aligned
```
| collum 1 | collum 2 | collum 3 |
| - | :-: | -: |
| item | item | item |
| item | item | item |

## Expand Section

```markdown
<details>
   <summary>Expand me</summary>

   ### Example
   `Example`
</details>
```
<details>
   <summary>Expand me</summary>

   ### Example
   `Example`
</details>

## Diagram

[Mermaid diagrams](https://docs.github.com/en/get-started/writing-on-github/working-with-advanced-formatting/creating-diagrams#creating-mermaid-diagrams)

## LaTeX

### inline
`$ \sqrt{3x-1}+(1+x)^2 $`

$ \sqrt{3x-1}+(1+x)^2 $

### block
`$$\left( \sum_{k=1}^n a_k b_k \right)^2 \leq \left( \sum_{k=1}^n a_k^2 \right) \left(\sum_{k=1}^n b_k^2 \right)$$`

$$\left( \sum_{k=1}^n a_k b_k \right)^2 \leq \left( \sum_{k=1}^n a_k^2 \right) \left(\sum_{k=1}^n b_k^2 \right)$$

