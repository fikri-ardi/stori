import "@phosphor-icons/web/light";
import "@phosphor-icons/web/fill";
import "@phosphor-icons/web/bold";

import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import { Markdown } from 'tiptap-markdown';
import Link from '@tiptap/extension-link'

window.setupEditor = function ({ content, model, live = false, debounce = null }) {
  let editor
  let syncTimeout

  return {
    content,
    model,
    live,
    debounce,

    syncToServer(value) {
      if (!this.live) return

      window.clearTimeout(syncTimeout)

      let sync = () => this.$wire.$set(this.model, value, true)

      if (this.debounce) {
        syncTimeout = window.setTimeout(sync, this.debounce)
        return
      }

      sync()
    },

    init(element) {
      editor = new Editor({
        element: element,
        editorProps: {
          attributes: {
            class: 'tiptap-editor p-2 min-h-60 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 focus:outline-none',
          },
        },
        extensions: [
          StarterKit.configure({
            heading: {
              levels: [2, 3, 4],
            },
          }),
          Markdown,
          Link.configure({
            autolink: true,
            defaultProtocol: 'https',
          }),
        ],
        content: this.content,
        onUpdate: ({ editor }) => {
          const markdown = editor.storage.markdown.getMarkdown()

          this.content = markdown
          this.syncToServer(markdown)
        },
      })

      this.editor = editor
      this.toggleBold = () => editor.chain().focus().toggleBold().run();
      this.toggleItalic = () => editor.chain().focus().toggleItalic().run();
      this.toggleH2 = () =>  editor.chain().focus().toggleHeading({ level: 2 }).run();
      this.toggleH3 = () =>  editor.chain().focus().toggleHeading({ level: 3 }).run();
      this.toggleH4 = () =>  editor.chain().focus().toggleHeading({ level: 4 }).run();
      this.toggleOrderedList = () =>  editor.chain().focus().toggleOrderedList().run();
      this.toggleBulletList = () =>  editor.chain().focus().toggleBulletList().run();

      this.$watch('content', (content) => {
        if (content === editor.storage.markdown.getMarkdown()) return
          editor.commands.setContent(content, false)
      })

      editor.commands.setContent(this.content, false)
    },
  }
}
